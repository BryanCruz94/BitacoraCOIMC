<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CivilianLog;
use Carbon\Carbon;

class CivillianLogController extends Controller
{
    public function index(){
        $civilianLogs = CivilianLog::join('users as U', 'U.id', '=', 'civilian_logs.userIn_id')
            ->join('ranks as R', 'U.rank_id', '=', 'R.code')
            ->select(
                'civilian_logs.id',
                DB::raw("CONCAT(civilian_logs.last_names, ' ', civilian_logs.names) as civilian"),
                'civilian_logs.hour_in',
                'civilian_logs.activity',
                'civilian_logs.transport',
                DB::raw("CONCAT(R.name, ' ' ,U.last_names, ' ', U.names) as user")
            )
            ->orderBy('civilian_logs.hour_in')
            ->whereNull('civilian_logs.hour_out')
            ->get();
        return view('civilianLog.index', compact('civilianLogs'));

    }

    public function store(Request $request){
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
        return redirect()->route('civilians.index');
    }
}
