<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleLog;
use Illuminate\Support\Facades\DB;
use App\Models\Pass;
use Carbon\Carbon;
use App\Models\Vehicle;
use App\Models\Novelty;
use App\Models\Driver;
use App\Models\Rank;

class VehicleLogController extends Controller
{
    public function index()
    {
        $vehicleLogs = VehicleLog::join('passes as P', 'vehicle_logs.pass_id', '=', 'P.id')
            ->join('vehicles as V', 'P.vehicle_id', '=', 'V.id')
            ->join('military_units as M', 'V.military_unit_id', '=', 'M.id')
            ->join('drivers as D', 'D.id', '=', 'P.driver_id')
            ->join('ranks as RD', 'D.rank_id', '=', 'RD.code')
            ->join('users as UO', 'UO.id', '=', 'vehicle_logs.userOut_id')
            ->join('ranks as RO', 'UO.rank_id', '=', 'RO.code')
            ->leftJoin('users as UI', 'UI.id', '=', 'vehicle_logs.userIn_id')
            ->leftJoin('ranks as RI', 'UI.rank_id', '=', 'RI.code')
            ->select(
                'vehicle_logs.id',
                'V.plate',
                'V.description',
                'M.abbreviation',
                'P.destination',
                'P.mission',
                'vehicle_logs.observation',
                'vehicle_logs.departure_time',
                'vehicle_logs.entry_time',
                DB::raw('vehicle_logs.entry_km - vehicle_logs.departure_km as totalKm'),
                DB::raw("CONCAT(RD.name, ' ', D.last_names, ' ', D.names) as driver"),
                DB::raw("CONCAT(RO.name, ' ', UO.last_names, ' ', UO.names) as guardOut"),
                DB::raw("CONCAT(RI.name, ' ', UI.last_names, ' ', UI.names) as guardIn")
            )
            ->orderBy('vehicle_logs.departure_time', 'desc')
            ->get();

        $vehiclesToOut = VehicleLog::join('passes as P', 'vehicle_logs.pass_id', '=', 'P.id')
            ->join('vehicles as V', 'P.vehicle_id', '=', 'V.id')
            ->join('military_units as M', 'V.military_unit_id', '=', 'M.id')
            ->join('drivers as D', 'D.id', '=', 'P.driver_id')
            ->join('ranks as RD', 'D.rank_id', '=', 'RD.code')
            ->join('users as UO', 'UO.id', '=', 'vehicle_logs.userOut_id')
            ->join('ranks as RO', 'UO.rank_id', '=', 'RO.code')
            ->select(
                'M.abbreviation',
                'V.plate',
                'V.description',
                DB::raw("CONCAT(RD.name, ' ', D.last_names, ' ', D.names) as driver"),
                'vehicle_logs.departure_time',
                'P.destination',
                'P.mission',
                DB::raw("CONCAT(RO.name, ' ', UO.last_names, ' ', UO.names) as guardOut")
            )
            ->whereNull('vehicle_logs.entry_time')
            ->orderBy('vehicle_logs.departure_time')
            ->get();

        $vehiclesOut = VehicleLog::join('passes as P', 'vehicle_logs.pass_id', '=', 'P.id')
            ->join('vehicles as V', 'P.vehicle_id', '=', 'V.id')
            ->join('military_units as M', 'V.military_unit_id', '=', 'M.id')
            ->select(
                'M.abbreviation',
                'V.plate',
                'V.description',
                'P.destination',
                'P.mission',
            )
            ->whereNull('vehicle_logs.entry_time')
            ->orderBy('M.abbreviation')
            ->orderBy('V.plate')
            ->get();


        $passes = Pass::join('users as UL', 'passes.user_id', '=', 'UL.id')
            ->join('ranks as RL', 'UL.rank_id', '=', 'RL.code')
            ->join('users as UA', 'passes.authorized_user_id', '=', 'UA.id')
            ->join('ranks as RA', 'UA.rank_id', '=', 'RA.code')
            ->join('vehicles as V', 'V.id', '=', 'passes.vehicle_id')
            ->join('drivers as D', 'D.id', '=', 'passes.driver_id')
            ->join('ranks as DR', 'D.rank_id', '=', 'DR.code')
            ->join('military_units as MU', 'V.military_unit_id', '=', 'MU.id')
            ->select(
                'passes.id',
                'passes.destination',
                'passes.mission',
                'passes.authorized_commander',
                'MU.abbreviation as unit',
                DB::raw("CONCAT(V.plate, ' ', V.description) as vehicle"),
                DB::raw("CONCAT(DR.name, ' ', D.last_names, ' ', D.names) as driver"),
                DB::raw("CONCAT(RL.name, ' ', UL.last_names, ' ', UL.names) as userLog"),
                DB::raw("CONCAT(RA.name, ' ', UA.last_names, ' ', UA.names) as userAuth")
            )
            ->where('passes.authorized_commander', 1)
            ->where('V.in_barracks', 1)
            ->where('passes.ejecuted', 0)
            ->orderBy('MU.abbreviation')
            ->orderBy('vehicle')
            ->get();

        return view('vehicleLog.index', compact('vehicleLogs', 'vehiclesToOut', 'passes', 'vehiclesOut'));
    }

    public function create($id)
    {
        $pass = Pass::find($id);
        return view('vehicleLog.create', compact('pass'));
    }

    public function store(Request $request)
    {
        $vehicleLog = new VehicleLog();
        $vehicleLog->pass_id = $request->pass_id;
        $vehicleLog->userOut_id = auth()->user()->id;
        $vehicleLog->departure_km = $request->departure_km;
        $vehicleLog->departure_time = Carbon::now()->setTimezone('America/Guayaquil');
        $vehicleLog->observation = null;
        $vehicleLog->save();

        $pass = Pass::find($request->pass_id);
        $pass->ejecuted = 1;
        $pass->save();

        $vehicle = Vehicle::find($pass->vehicle_id);
        $vehicle->in_barracks = 0;
        $vehicle->save();

        $driver = Driver::find($pass->driver_id);
        $rankDriver = Rank::find($driver->rank_id);

        $novelty = new Novelty();
        $nuevaNovedad = "Salida de vehículo " . $vehicle->description . " placas " . $vehicle->plate . " " .
            " con destino: " . $pass->destination . ". Misión " . $pass->mission .
            ". Conductor: " . $rankDriver->name . ' ' . $driver->names . " " . $driver->last_names;
        $novelty->novelty = $nuevaNovedad;
        $novelty->user_id = auth()->user()->id;
        $novelty->hour = Carbon::now()->setTimezone('America/Guayaquil');
        $novelty->save();

        return redirect()->route('vehicleLog.index');
    }

    public function obtenerDatosVehiculo($placa)
    {
        $vehiclesOut = VehicleLog::join('passes as P', 'vehicle_logs.pass_id', '=', 'P.id')
            ->join('vehicles as V', 'P.vehicle_id', '=', 'V.id')
            ->join('military_units as M', 'V.military_unit_id', '=', 'M.id')
            ->select(
                'vehicle_logs.id',
                'V.description',
                'M.abbreviation',
                'V.plate',
                'V.description',
                'P.destination',
                'P.mission',
                'vehicle_logs.departure_km',
            )
            ->where('V.plate', $placa)
            ->whereNull('vehicle_logs.entry_time')
            ->orderBy('M.abbreviation')
            ->orderBy('V.plate')
            ->first(); // Cambiado a first() para obtener un solo resultado

        if ($vehiclesOut) {
            $data = [
                'unit' => $vehiclesOut->abbreviation,
                'destination' => $vehiclesOut->destination,
                'id' => $vehiclesOut->id,
                'mission' => $vehiclesOut->mission,
                'description' => $vehiclesOut->description,
                'departure_km' => $vehiclesOut->departure_km,
            ];

            return response()->json($data);
        } else {
            // Manejo si no se encuentra ningún registro
            return response()->json(['error' => 'No se encontraron datos para la placa especificada'], 404);
        }
    }

    public function update(Request $request)
    {
        $vehicleLog = VehicleLog::find($request->id_vehicle_log);
        $vehicleLog->userIn_id = auth()->user()->id;
        $vehicleLog->entry_km = $request->entry_km;
        $vehicleLog->entry_time = Carbon::now()->setTimezone('America/Guayaquil');
        $vehicleLog->observation = $request->observation;
        $vehicleLog->save();

        $pass = Pass::find($vehicleLog->pass_id);

        $vehicle = Vehicle::find($pass->vehicle_id);
        $vehicle->in_barracks = 1;
        $vehicle->save();

        $novelty = new Novelty();
        $nuevaNovedad = "Ingresa de vehículo con placa " . $vehicle->plate . " " . $vehicle->description .
            " que se encontraba en " . $pass->destination . " realizando: " . $pass->mission;
        $novelty->novelty = $nuevaNovedad;
        $novelty->user_id = auth()->user()->id;
        $novelty->hour = Carbon::now()->setTimezone('America/Guayaquil');
        $novelty->save();

        return redirect()->route('vehicleLog.index');

    }
}
