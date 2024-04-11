<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Novelty;
use Carbon\Carbon;

class NoveltyController extends Controller
{

    public function index()
    {
        $novelties = Novelty::join('users as u', 'novelties.user_id', '=', 'u.id')
            ->orderByDesc('hour')
            ->limit(50)
            ->get(['novelties.novelty', 'novelties.hour', DB::raw("CONCAT(u.names, ' ', u.last_names) as Guard")]);

        return view('novelty.index', compact('novelties'));
    }

    public function store(Request $request)
    {
        $noveltie = new Novelty();

        $noveltie -> hour = Carbon::now()->setTimezone('America/Guayaquil');
        $noveltie -> novelty = $request -> novelty;
        $noveltie -> user_id = auth()->user()->id;

        $noveltie -> save();
        return redirect()->route('novelty.index');

    }


}
