<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pass;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PassesController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $unitUser = $user->military_unit_id;
        $roleUser = $user->roles->first()->name;

        $vehicles = Vehicle::where('military_unit_id', $unitUser)
            ->where('is_active', 1)
            ->where('in_barracks', 1)
            ->where('military_unit_id', $unitUser)
            ->orderBy('plate')
            ->get();

        $drivers = Driver::where('military_unit_id', $unitUser)
            ->join('ranks as R', 'drivers.rank_id', '=', 'R.code')
            ->select(
                'drivers.id',
                DB::raw("CONCAT(R.name, ' ', drivers.last_names, ' ', drivers.names) as names")
            )
            ->where('is_active', 1)
            ->where('military_unit_id', $unitUser)
            ->orderBy('names')
            ->get();

        $passes = Pass::join('users as UL', 'passes.user_id', '=', 'UL.id')
            ->join('ranks as RL', 'UL.rank_id', '=', 'RL.code')
            ->leftjoin('users as UA', 'passes.authorized_user_id', '=', 'UA.id')
            ->leftjoin('ranks as RA', 'UA.rank_id', '=', 'RA.code')
            ->join('vehicles as V', 'V.id', '=', 'passes.vehicle_id')
            ->join('drivers as D', 'D.id', '=', 'passes.driver_id')
            ->join('ranks as DR', 'D.rank_id', '=', 'DR.code')
            ->select(
                'passes.id',
                'passes.destination',
                'passes.mission',
                'passes.authorized_commander',
                'passes.created_at',
                'passes.ejecuted',
                DB::raw("CONCAT(V.plate, ' ', V.description) as vehicle"),
                DB::raw("CONCAT(DR.name, ' ', D.last_names, ' ', D.names) as driver"),
                DB::raw("CONCAT(RL.name, ' ', UL.last_names, ' ', UL.names) as userLog"),
                DB::raw("CONCAT(RA.name, ' ', UA.last_names, ' ', UA.names) as userAuth")
            )
            ->where('UL.military_unit_id', $unitUser)
            ->orderBy('passes.created_at', 'desc')
            ->get();
        return view('vehiclePass.index', compact('passes', 'roleUser', 'vehicles', 'drivers'));
    }

    public function store(Request $request)
    {
        $pass = new Pass();
        $pass->user_id = auth()->user()->id;
        $pass->vehicle_id = $request->vehicle_id;
        $pass->driver_id = $request->driver_id;
        $pass->destination = $request->destination;
        $pass->mission = $request->mission;
        $pass->authorized_commander = 0;
        $pass->authorized_user_id = null;
        $pass->ejecuted = 0;
        $pass->created_at = Carbon::now()->setTimezone('America/Guayaquil');

        $pass->save();

        return redirect()->route('passes.index');
    }

    // metodo destroy
    public function destroy($id)
    {
        $pass = Pass::find($id);
        $pass->delete();
        return redirect()->route('passes.index');
    }

    public function destroy2($id)
    {
        $pass = Pass::find($id);
        $pass->delete();
        return redirect()->route('passes.indexAuth');
    }


    public function indexAuth()
    {
        $user = auth()->user();
        $unitUser = $user->military_unit_id;
        $roleUser = $user->roles->first()->name;


        $passes = Pass::join('users as UL', 'passes.user_id', '=', 'UL.id')
            ->join('ranks as RL', 'UL.rank_id', '=', 'RL.code')
            ->join('vehicles as V', 'V.id', '=', 'passes.vehicle_id')
            ->join('drivers as D', 'D.id', '=', 'passes.driver_id')
            ->join('ranks as DR', 'D.rank_id', '=', 'DR.code')
            ->select(
                'passes.id',
                'passes.destination',
                'passes.mission',
                'passes.created_at',
                DB::raw("CONCAT(V.plate, ' ', V.description) as vehicle"),
                DB::raw("CONCAT(DR.name, ' ', D.last_names, ' ', D.names) as driver"),
                DB::raw("CONCAT(RL.name, ' ', UL.last_names, ' ', UL.names) as userLog"),
            )
            ->where('UL.military_unit_id', $unitUser)
            ->where('passes.authorized_user_id', null)
            ->orderBy('passes.created_at', 'desc')
            ->get();
        return view('vehiclePass.indexAuth', compact('passes', 'roleUser'));
    }

   public function updateAuth($id)
    {
        $pass = Pass::find($id);
        $pass->authorized_user_id = auth()->user()->id;
        $pass->authorized_commander = 1;
        $pass->updated_at = Carbon::now()->setTimezone('America/Guayaquil');
        $pass->save();
        return redirect()->route('passes.indexAuth');
    }
}
