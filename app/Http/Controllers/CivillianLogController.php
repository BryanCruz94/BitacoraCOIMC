<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CivilianLog;
use App\Models\Novelty;
use Carbon\Carbon;

class CivillianLogController extends Controller
{
    public function index()
    {
        $civilianLogs = CivilianLog::join('users as U', 'U.id', '=', 'civilian_logs.userIn_id')
            ->join('ranks as R', 'U.rank_id', '=', 'R.code')
            ->select(
                'civilian_logs.id',
                DB::raw("CONCAT(civilian_logs.last_names, ' ', civilian_logs.names) as civilian"),
                'civilian_logs.identification_card',
                'civilian_logs.hour_in',
                'civilian_logs.activity',
                'civilian_logs.transport',
                DB::raw("CONCAT(R.name, ' ' ,U.last_names, ' ', U.names) as user")
            )
            ->orderBy('civilian_logs.hour_in')
            ->whereNull('civilian_logs.hour_out')
            ->get();



        $civiliansOut = CivilianLog::join('users as UI', 'UI.id', '=', 'civilian_logs.userIn_id')
            ->join('ranks as RI', 'RI.code', '=', 'UI.rank_id')
            ->join('users as UO', 'UO.id', '=', 'civilian_logs.userOut_id')
            ->join('ranks as RO', 'RO.code', '=', 'UO.rank_id')
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
            ->orderByDesc('civilian_logs.hour_in')
            ->get();


        return view('civilianLog.index', compact('civilianLogs','civiliansOut'));
    }

    public function store(Request $request)
    {
        $civilianLog = new CivilianLog();
        $civilianLog->last_names = $request->last_names;
        $civilianLog->names = $request->names;
        $civilianLog->identification_card = $request->identification_card;
        $civilianLog->hour_in = Carbon::now()->setTimezone('America/Guayaquil');
        $civilianLog->hour_out = null;
        $civilianLog->activity = $request->activity;
        $civilianLog->transport = $request->transport;
        $civilianLog->userIn_id = auth()->user()->id;
        $civilianLog->save();

        // Se crea un String para guardar la novedad en la tabla Novelties
        $noveltie = new Novelty();
        $noveltie->hour = Carbon::now()->setTimezone('America/Guayaquil');
        $noveltie->novelty = 'Se ha registrado el ingreso del personal civil: ' . $request->last_names . ' ' . $request->names
        . ' con cédula: ' . $request->identification_card . ' a realizar la actividad: ' . $request->activity;
        $noveltie->user_id = auth()->user()->id;
        $noveltie->save();
        return redirect()->route('civilians.index');
    }

    public function edit($id)
    {
        $civilian = CivilianLog::find($id);
        return view('civilianLog.edit', compact('civilian'));
    }

    public function update(Request $request, $id)
    {
        $civilianLog = CivilianLog::find($id);
        $civilianLog->hour_out = Carbon::now()->setTimezone('America/Guayaquil');
        $civilianLog->userOut_id = auth()->user()->id;
        $civilianLog->save();

        // Se crea un String para guardar la novedad en la tabla Novelties
        $noveltie = new Novelty();
        $noveltie->hour = Carbon::now()->setTimezone('America/Guayaquil');
        $noveltie->novelty = 'Se ha registrado la salida de personal civil: ' . $civilianLog->last_names . ' ' . $civilianLog->names;
        $noveltie->user_id = auth()->user()->id;
        $noveltie->save();
        return redirect()->route('civilians.index');
    }
}
