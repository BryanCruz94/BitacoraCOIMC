<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PendingTask;
use App\Models\Novelty;
use Carbon\Carbon;

class PendingTaskController extends Controller
{
    public function index()
    {
        $penddings = PendingTask::join('users as g', 'g.id', '=', 'pending_tasks.userCreate_id')
            ->join('ranks as r', 'g.rank_id', '=', 'r.code')
            ->where('pending_tasks.task_done', 0)
            ->orderBy('pending_tasks.id')
            ->get([
                'pending_tasks.id', 'pending_tasks.hour_create', 'pending_tasks.pending_task',
                DB::raw("CONCAT(r.name,' ',g.last_names, ' ', g.names) as guardCreate")
            ]);

        $penddingsDone = PendingTask::join('users as gc', 'gc.id', '=', 'pending_tasks.userCreate_id')
            ->join('users as gd', 'gd.id', '=', 'pending_tasks.userDone_id')
            ->join('ranks as rd', 'gd.rank_id', '=', 'rd.code')
            ->join('ranks as rc', 'gc.rank_id', '=', 'rc.code')
            ->orderByDesc('pending_tasks.hour_create')
            ->limit(50)
            ->get([
                'pending_tasks.pending_task',
                'pending_tasks.hour_create',
                'pending_tasks.hour_done',
                DB::raw("CONCAT(rc.name, ' ', gc.names, ' ', gc.last_names) as guardCreate"),
                DB::raw("CONCAT(rd.name, ' ', gd.names, ' ', gd.last_names) as guardDone"),
                'pending_tasks.observations'
            ]);

        return view('pendingTask.index', compact('penddings', 'penddingsDone'));
    }

    public function store(Request $request)
    {
        $pending = new PendingTask();

        $pending->hour_create = Carbon::now()->setTimezone('America/Guayaquil');
        $pending->pending_task = $request->newPendding;
        $pending->task_done = 0;
        $pending->observations = '';
        $pending->userCreate_id = auth()->user()->id;

        $pending->save();
        return redirect()->route('pending.index');
    }

    public function edit($id)
    {
        $pending = PendingTask::find($id);

        return view('pendingTask.editPendings', compact('pending'));
    }

    public function update(Request $request,  $id)
    {
        $pendding = PendingTask::find($id);

        $pendding->task_done=1;
        $pendding->observations=$request->observations;
        $pendding->hour_done=Carbon::now()->setTimezone('America/Guayaquil');
        $pendding->userDone_id=auth()->user()->id;

        $pendding->save();

        // Se crea un String para guardar la novedad en la tabla Novelties
        $noveltie = new Novelty();
        $noveltie->hour=Carbon::now()->setTimezone('America/Guayaquil');
        $noveltie->novelty='Se ha realizado la consigna: '.$pendding->pending_task . '. Con la/las siguientes observaciones: '. $request->observations;
        $noveltie->user_id=auth()->user()->id;
        $noveltie->save();

        // Se redirecciona a la vista pendings
        return redirect()->route('pending.index');
    }
}
