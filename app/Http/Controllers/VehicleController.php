<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\MilitaryUnit;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class VehicleController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $unitUser = $user->military_unit_id;
        $roleUser = $user->roles->first()->name;


        $military_units = MilitaryUnit::all();

        if($roleUser == 'Admin'){
            $vehicles = Vehicle::join('military_units as M', 'vehicles.military_unit_id', '=', 'M.id')
                ->select(
                    'vehicles.id',
                    'M.abbreviation as military_unit',
                    'vehicles.plate',
                    'img_url',
                    'vehicles.description',
                    'vehicles.in_barracks'
                )
                ->orderBy('M.abbreviation')
                ->orderBy('vehicles.description')
                ->orderBy('vehicles.plate')
                ->get();
            return view('admin.vehicle.index', compact('vehicles', 'military_units', 'roleUser'));
        }else{
            $vehicles = Vehicle::join('military_units as M', 'vehicles.military_unit_id', '=', 'M.id')
                ->select(
                    'vehicles.id',
                    'M.abbreviation as military_unit',
                    'vehicles.plate',
                    'img_url',
                    'vehicles.description',
                    'vehicles.in_barracks'
                )
                ->where('M.id', $unitUser)
                ->where('vehicles.is_active', true)
                ->orderBy('vehicles.description')
                ->orderBy('vehicles.plate')
                ->get();
            return view('admin.vehicle.index', compact('vehicles', 'military_units', 'roleUser'));
        }

    }

    public function store(Request $request)
    {
        $vehicle = new Vehicle();
        $vehicle->description = $request->description;
        $vehicle->plate = $request->plate;
        $vehicle->in_barracks = $request->has('in_barracks');
        $vehicle->military_unit_id = $request->military_unit_id;

        // Subir la imagen a Cloudinary
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => 'COIMC_PICS', // Reemplaza 'nombre_de_la_carpeta_en_cloudinary' por el nombre de la carpeta que deseas utilizar
        ])->getSecurePath();
        $url_img = $uploadedFileUrl; // Aquí puedes asignar el valor de la URL de la imagen a tu campo url_img en la base de datos


        $vehicle->img_url = $url_img;
        $vehicle->is_active = true;
        $vehicle->save();
        return redirect()->route('vehicles.index');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::find($id);
        $military_units = MilitaryUnit::all();

        return view('admin.vehicle.edit', compact('vehicle', 'military_units'));
    }

    public function update(Request $request)
    {
        $id=$request->id;
        $vehicle = Vehicle::find($id);
        $vehicle->description = $request->description;
        $vehicle->plate = $request->plate;
        $vehicle->in_barracks = $request->has('in_barracks');

        if($request->hasFile('image')) {
            // Subir la imagen a Cloudinary
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'COIMC_PICS', // Reemplaza 'nombre_de_la_carpeta_en_cloudinary' por el nombre de la carpeta que deseas utilizar
            ])->getSecurePath();
            $url_img = $uploadedFileUrl; // Aquí puedes asignar el valor de la URL de la imagen a tu campo url_img en la base de datos
            $vehicle->img_url = $url_img;
        }

        $vehicle->military_unit_id = $request->military_unit_id;
        $vehicle->save();
        return redirect()->route('vehicles.index');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->is_active = false;
        $vehicle->save();
        return redirect()->route('vehicles.index');
    }

    public function delete($id)
    {
        $vehicle = Vehicle::find($id);
        return view('admin.vehicle.delete', compact('vehicle'));
    }


}
