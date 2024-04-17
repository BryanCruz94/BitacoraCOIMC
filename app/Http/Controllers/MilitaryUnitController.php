<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MilitaryUnit;

class MilitaryUnitController extends Controller
{
    public function index()
    {
        $militaryUnits = MilitaryUnit::orderBy('is_active', 'desc')->orderBy('name', 'asc')->get();
        return view('admin.militaryUnit.index', compact('militaryUnits'));
    }

    public function store(Request $request)
    {
        $military_unit = new MilitaryUnit();
        $military_unit->name = $request->name;
        $military_unit->abbreviation = $request->abbreviation;
        $military_unit->commander = $request->commander;
        $military_unit->address = $request->address;
        $military_unit->is_active = true;
        $military_unit->save();

        return redirect()->route('military_units.index');
    }

    public function edit($id)
    {
        $unit = MilitaryUnit::find($id);
        return view('admin.militaryUnit.edit', compact('unit'));
    }

    public function update(Request $request)
    {
        $military_unit = MilitaryUnit::find($request->id);
        $military_unit->name = $request->name;
        $military_unit->abbreviation = $request->abbreviation;
        $military_unit->commander = $request->commander;
        $military_unit->address = $request->address;
        $military_unit->is_active = $request->has('is_active');
        $military_unit->updated_at = now();
        $military_unit->save();

        return redirect()->route('military_units.index');
    }

   
}
