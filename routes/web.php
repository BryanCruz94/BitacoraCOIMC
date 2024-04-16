<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoveltyController;
use App\Http\Controllers\PendingTaskController;
use App\Http\Controllers\CivillianLogController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;



Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/home', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/admin', function () {
    return view('admin.index');
})->middleware('auth');


/****************** INICIO RUTAS PARA LA BITÁCOTA ****************/
Route::get('/binacle', [NoveltyController::class, 'index'])->middleware('auth')->name('novelty.index');
Route::post('/binnacle/newNovelty', [NoveltyController::class,'store'])->middleware('auth')->name("novelty.store");
/****************** FIN RUTAS PARA LA BITÁCOTA ****************/


/****************** INICIO RUTAS PARA LAS CONSIGNAS ****************/
Route::get('/pendings', [PendingTaskController::class,'index'])->middleware('auth')->name("pending.index");
Route::post('/pendings/newPending', [PendingTaskController::class,'store'])->middleware('auth')->name("pending.store");
Route::post('/pendings/edit/{id}', [PendingTaskController::class, 'edit'])->middleware('auth')-> name ('pendings.editDone');
Route::post('/pendings/update/{id}', [PendingTaskController::class, 'update'])->middleware('auth')->name('pendings.update');
/****************** FIN RUTAS PARA LAS CONSIGNAS ****************/


/****************** INICIO RUTAS PARA MOVIMIENTO DE CIVILES ****************/
Route::get('/civilians', [CivillianLogController::class, 'index'])->middleware('auth')->name('civilians.index');
Route::post('/civilians/newEntrance', [CivillianLogController::class,'store'])->middleware('auth')->name("civilians.store");
Route::post('/civilians/newExit/{id}', [CivillianLogController::class,'edit'])->middleware('auth')->name("civilians.edit");
Route::post('/civilians/update/{id}', [CivillianLogController::class,'update'])->middleware('auth')->name("civilians.update");
/****************** FIN RUTAS PARA MOVIMIENTO DE CIVILES ****************/

/****************** INICIO RUTAS PARA ADMINISTRACIÓN VEHICULAR ****************/
Route::get('/admin/vehicles', [VehicleController::class, 'index'])->middleware('auth')->name('vehicles.index');
Route::post('/admin/vehicles/newVehicle', [VehicleController::class,'store'])->middleware('auth')->name("vehicles.store");
Route::post('/admin/vehicles/edit/{id}', [VehicleController::class, 'edit'])->middleware('auth')-> name ('vehicles.edit');
Route::post('/admin/vehicles/update', [VehicleController::class, 'update'])->middleware('auth')->name('vehicles.update');
Route::post('/admin/vehicles/delete/{id}', [VehicleController::class, 'delete'])->middleware('auth')->name('vehicles.delete');
Route::post('/admin/vehicles/destroy/{id}', [VehicleController::class, 'destroy'])->middleware('auth')->name('vehicles.destroy');
/****************** FIN RUTAS PARA ADMINISTRACIÓN VEHICULAR ****************/

/****************** INICIO RUTAS PARA ADMINISTRACIÓN DE CONDUCTORES ****************/
Route::get('/admin/drivers', [DriverController::class, 'index'])->middleware('auth')->name('drivers.index');
Route::post('/admin/drivers/newDriver', [DriverController::class,'store'])->middleware('auth')->name("drivers.store");

Auth::routes();


