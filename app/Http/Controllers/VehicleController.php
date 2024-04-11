<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\MilitaryUnit;

class VehicleController extends Controller
{
    public function index()
    {
        $unitUser = auth()->user()->military_unit_id;
        $military_units = MilitaryUnit::all();
        $vehicles = Vehicle::join('military_units as M', 'vehicles.military_unit_id', '=', 'M.id')
            ->select('vehicles.id', 'M.abbreviation as military_unit', 'vehicles.plate', 'vehicles.description', 'vehicles.in_barracks')
            ->where('M.id', $unitUser)
            ->get();
        return view('admin.vehicle.index', compact('vehicles','military_units'));
    }

    public function store(Request $request)
    {
        $vehicle = new Vehicle();
        $vehicle->description = $request->description;
        $vehicle->plate = $request->plate;
        $vehicle->in_barracks = $request->has('in_barracks');
        $vehicle->military_unit_id = $request->military_unit_id;
        $vehicle->is_active = true;
        $vehicle->save();
        return redirect()->route('vehicles.index');
    }
}
