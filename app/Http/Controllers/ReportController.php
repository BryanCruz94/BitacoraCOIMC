<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Novelty;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\VehicleLog;
use App\Models\CivilianLog;
use App\Models\Pass;


class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function generateNovelties(Request $request)
    {
        $fechaInicio = $request->post('fechaInicio');
        $fechaFin = $request->post('fechaFin');
        $fechaHoy =  Carbon::now()->format('dMY-H:i');

        $novelties = Novelty::join('users as u', 'novelties.user_id', '=', 'u.id')
            ->join('ranks as r', 'u.rank_id', '=', 'r.code')
            ->where('novelties.hour','>=',$fechaInicio)
            ->where('novelties.hour','<=',$fechaFin)
            ->orderBy('hour')
            ->get(['novelties.novelty', 'novelties.hour', DB::raw("CONCAT(r.name,' ', u.last_names, ' ', u.names) as Guard")]);

        $pdf = Pdf::loadView('report.reporteNovedades', compact('novelties', 'fechaInicio', 'fechaFin'))->setPaper('a4', 'portrait');

        return $pdf->download('ReporteNovedades' . $fechaHoy . '.pdf');
    }

    public function generateVehicleLog(Request $request)
    {
        $fechaInicio = $request->post('fechaInicio');
        $fechaFin = $request->post('fechaFin');
        $fechaHoy =  Carbon::now()->format('dMY-H:i');

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
            ->where('vehicle_logs.departure_time','>=',$fechaInicio)
            ->where('vehicle_logs.departure_time','<=',$fechaFin)
            ->orderBy('vehicle_logs.departure_time')
            ->get();

        $vehiclesOut = VehicleLog::join('passes as P', 'vehicle_logs.pass_id', '=', 'P.id')
            ->join('vehicles as V', 'P.vehicle_id', '=', 'V.id')
            ->join('military_units as M', 'V.military_unit_id', '=', 'M.id')
            ->select(
                'M.abbreviation',
                'V.plate',
                'V.description',
                'vehicle_logs.departure_time',
                'P.destination',
                'P.mission',
            )
            ->whereNull('vehicle_logs.entry_time')
            ->orderBy('M.abbreviation')
            ->orderBy('V.plate')
            ->get();

        $pdf = Pdf::loadView('report.reporteMovimientoVehicular', compact('vehicleLogs', 'vehiclesOut', 'fechaInicio', 'fechaFin'))->setPaper('a4', 'landscape');

        return $pdf->download('ReporteMovimientoVehicular' . $fechaHoy . '.pdf');
    }

    public function generateCivilianLog(Request $request)
    {
        $fechaInicio = $request->post('fechaInicio');
        $fechaFin = $request->post('fechaFin');
        $fechaHoy =  Carbon::now()->format('dMY-H:i');

        $civilianLogs = CivilianLog::join('users as UI', 'UI.id', '=', 'civilian_logs.userIn_id')
            ->join('ranks as RI', 'RI.code', '=', 'UI.rank_id')
            ->leftJoin('users as UO', 'UO.id', '=', 'civilian_logs.userOut_id')
            ->leftJoin('ranks as RO', 'RO.code', '=', 'UO.rank_id')
            ->select(
                DB::raw("CONCAT(civilian_logs.last_names, ' ', civilian_logs.names) as civilian"),
                'civilian_logs.identification_card',
                'civilian_logs.hour_in',
                'civilian_logs.hour_out',
                'civilian_logs.activity',
                'civilian_logs.transport',
                DB::raw("CONCAT(RI.name, ' ', UI.last_names, ' ', UI.names) as user_in"),
                DB::raw("CONCAT(RO.name, ' ', UO.last_names, ' ', UO.names) as user_out")
            )
            ->where('civilian_logs.hour_in','>=',$fechaInicio)
            ->where('civilian_logs.hour_in','<=',$fechaFin)
            ->orderByDesc('civilian_logs.hour_in')
            ->get();

        $pdf = Pdf::loadView('report.reporteCiviles', compact('civilianLogs', 'fechaInicio', 'fechaFin'))->setPaper('a4', 'portrait');

        return $pdf->download('ReportePersonalCivil' . $fechaHoy . '.pdf');
    }

    public function imprimirSalvocunducto($id){
        $fechaHoy =  Carbon::now()->format('dMY-H:i');
        $pass = Pass::join('users as UA', 'UA.id', '=', 'passes.authorized_user_id')
        ->join('ranks as RA', 'RA.code', '=', 'UA.rank_id')
        ->join('users as UL', 'UL.id', '=', 'passes.user_id')
        ->join('ranks as RL', 'RL.code', '=', 'UL.rank_id')
        ->join('vehicles as V', 'V.id', '=', 'passes.vehicle_id')
        ->join('drivers as D', 'D.id', '=', 'passes.driver_id')
        ->join('ranks as RD', 'RD.code', '=', 'D.rank_id')
        ->join('military_units as M', 'M.id', '=', 'V.military_unit_id')
        ->select(
            'passes.id',
            'passes.destination',
            'passes.mission',
            DB::raw("CONCAT(RL.name, ' ', UL.last_names, ' ', UL.names) as user_logistic"),
            DB::raw("CONCAT(RA.name, ' ', UA.last_names, ' ', UA.names) as user_authorized"),
            DB::raw("CONCAT(RD.name, ' ', D.last_names, ' ', D.names) as driver"),
            'V.plate',
            'V.description',
            'M.name as military_unit',)
        ->where('passes.id', $id)
        ->first();


        $pdf = PDF::loadView('report.salvoconducto', compact( 'fechaHoy','pass'))->setPaper('a4', 'portrait');
        return $pdf->download('Salvoconducto' . $fechaHoy . '.pdf');
    }
}
