<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoveltyController;
use App\Http\Controllers\PendingTaskController;
use App\Http\Controllers\CivillianLogController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\MilitaryUnitController;
use App\Http\Controllers\PassesController;
use App\Http\Controllers\VehicleLogController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
    return view('welcome');
})->middleware('auth')->name('welcome');

Route::get('/home', function () {
    return view('welcome');
})->middleware('auth')->name('home');

Route::get('/admin', function () {
    return view('admin.index');
})->middleware('auth')->name('admin.index');


/****************** INICIO RUTAS PARA LA BITÁCOTA ****************/
Route::get('/binacle', [NoveltyController::class, 'index'])->middleware('auth')->name('novelty.index');
Route::post('/binnacle/newNovelty', [NoveltyController::class,'store'])->middleware('auth')->name("novelty.store");
/****************** FIN RUTAS PARA LA BITÁCOTA ****************/


/****************** INICIO RUTAS PARA LAS CONSIGNAS ****************/
Route::get('/pendings', [PendingTaskController::class,'index'])->middleware('auth')->middleware('can:pending.index')->name("pending.index");
Route::post('/pendings/newPending', [PendingTaskController::class,'store'])->middleware('auth')->middleware('can:pending.index')->name("pending.store");
Route::post('/pendings/edit/{id}', [PendingTaskController::class, 'edit'])->middleware('auth')->middleware('can:guard.index')-> name ('pendings.editDone');
Route::post('/pendings/update/{id}', [PendingTaskController::class, 'update'])->middleware('auth')->name('pendings.update');
/****************** FIN RUTAS PARA LAS CONSIGNAS ****************/


/****************** INICIO RUTAS PARA MOVIMIENTO DE CIVILES ****************/
Route::get('/civilians', [CivillianLogController::class, 'index'])->middleware('auth')->middleware('can:guard.index')->name('civilians.index');
Route::post('/civilians/newEntrance', [CivillianLogController::class,'store'])->middleware('auth')->middleware('can:guard.index')->name("civilians.store");
Route::post('/civilians/newExit/{id}', [CivillianLogController::class,'edit'])->middleware('auth')->middleware('can:guard.index')->name("civilians.edit");
Route::post('/civilians/update/{id}', [CivillianLogController::class,'update'])->middleware('auth')->name("civilians.update");
/****************** FIN RUTAS PARA MOVIMIENTO DE CIVILES ****************/

/****************** INICIO RUTAS PARA ADMINISTRACIÓN VEHICULAR ****************/
Route::get('/admin/vehicles', [VehicleController::class, 'index'])->middleware('auth')->middleware('can:admin.index')->name('vehicles.index');
Route::post('/admin/vehicles/newVehicle', [VehicleController::class,'store'])->middleware('auth')->name("vehicles.store");
Route::post('/admin/vehicles/edit/{id}', [VehicleController::class, 'edit'])->middleware('auth')->middleware('can:admin.index')-> name ('vehicles.edit');
Route::post('/admin/vehicles/update', [VehicleController::class, 'update'])->middleware('auth')->name('vehicles.update');
Route::post('/admin/vehicles/delete/{id}', [VehicleController::class, 'delete'])->middleware('auth')->middleware('can:admin.index')->name('vehicles.delete');
Route::post('/admin/vehicles/destroy/{id}', [VehicleController::class, 'destroy'])->middleware('auth')->name('vehicles.destroy');
/****************** FIN RUTAS PARA ADMINISTRACIÓN VEHICULAR ****************/

/****************** INICIO RUTAS PARA ADMINISTRACIÓN DE CONDUCTORES ****************/
Route::get('/admin/drivers', [DriverController::class, 'index'])->middleware('auth')->middleware('can:admin.index')->name('drivers.index');
Route::post('/admin/drivers/newDriver', [DriverController::class,'store'])->middleware('auth')->name("drivers.store");
Route::post('/admin/drivers/edit/{id}', [DriverController::class, 'edit'])->middleware('auth')->middleware('can:admin.index')-> name ('drivers.edit');
Route::post('/admin/drivers/update', [DriverController::class, 'update'])->middleware('auth')->name('drivers.update');
Route::post('/admin/drivers/delete/{id}', [DriverController::class, 'delete'])->middleware('auth')->middleware('can:admin.index')->name('drivers.delete');
Route::post('/admin/drivers/destroy/{id}', [DriverController::class, 'destroy'])->middleware('auth')->name('drivers.destroy');
/****************** FIN RUTAS PARA ADMINISTRACIÓN DE CONDUCTORES ****************/

/****************** INICIO RUTAS PARA ADMINISTRACIÓN DE USUARIOS ****************/
Route::get('/admin/users', [UserController::class, 'index'])->middleware('auth')->middleware('can:superAdmin.index')->name('users.index');
Route::post('/admin/users/edit/{id}', [UserController::class,'edit'])->middleware('auth')->middleware('can:superAdmin.index')->name("users.edit");
Route::post('/admin/users/update', [UserController::class,'update'])->middleware('auth')->middleware('can:superAdmin.index')->name("users.update");
/****************** FIN RUTAS PARA ADMINISTRACIÓN DE USUARIOS ****************/

/****************** INICIO RUTAS PARA ADMINISTRACIÓN DE UNIDADES MILITARES ****************/
Route::get('/admin/military_units', [MilitaryUnitController::class, 'index'])->middleware('auth')->middleware('can:superAdmin.index')->name('military_units.index');
Route::post('/admin/military_units/newMilitaryUnit', [MilitaryUnitController::class,'store'])->middleware('auth')->middleware('can:superAdmin.index')->name("military_units.store");
Route::post('/admin/military_units/edit/{id}', [MilitaryUnitController::class, 'edit'])->middleware('auth')->middleware('can:superAdmin.index')-> name ('military_units.edit');
Route::post('/admin/military_units/update', [MilitaryUnitController::class, 'update'])->middleware('auth')->middleware('can:superAdmin.index')->name('military_units.update');
/****************** FIN RUTAS PARA ADMINISTRACIÓN DE UNIDADES MILITARES ****************/


/****************** INICIO RUTAS PARA ADMINISTRACIÓN DE SALVOCONDUCTOS ****************/
Route::get('/passes', [PassesController::class, 'index'])->middleware('auth')->middleware('can:pass.view')->name('passes.index');
Route::get('/passesAuth', [PassesController::class, 'indexAuth'])->middleware('auth')->middleware('can:pass.authorized')->name('passes.indexAuth');
Route::post('/passes/newPass', [PassesController::class,'store'])->middleware('auth')->middleware('can:pass.create')->name("passes.store");
Route::post('/passes/authorize/{id}', [PassesController::class, 'updateAuth'])->middleware('auth')->middleware('can:pass.authorized')->name('passes.authorize');
Route::post('/passes/destroy/{id}', [PassesController::class, 'destroy'])->middleware('auth')->name('passes.destroy');
Route::post('/passes/destroy2/{id}', [PassesController::class, 'destroy2'])->middleware('auth')->name('passes.destroy2');
/****************** FIN RUTAS PARA ADMINISTRACIÓN DE SALVOCONDUCTOS ****************/

/****************** INICIO RUTAS PARA BITÁCORA VEHICULAR  ****************/
Route::get('/vehicleLog', [VehicleLogController::class, 'index'])->middleware('auth')->name('vehicleLog.index');
Route::post('/vehicleLog/create/{id}', [VehicleLogController::class,'create'])->middleware('auth')->name("vehicleLog.create");
Route::post('/vehicleLog/store', [VehicleLogController::class,'store'])->middleware('auth')->name("vehicleLog.store");
Route::get('/obtener-datos-vehiculo/{placa}', [VehicleLogController::class, 'obtenerDatosVehiculo'])->middleware('auth')->name('vehicleLog.getVehicleData');
Route::post('/vehicleLog/update', [VehicleLogController::class, 'update'])->middleware('auth')->name('vehicleLog.update');
/****************** FIN RUTAS PARA BITÁCORA VEHICULAR ****************/

/****************** INICIO RUTAS PARA REPORTES ****************/
Route::get('/reports', [ReportController::class, 'index'])->middleware('auth')->name('reports.index');
Route::post('/reports/novelty', [ReportController::class, 'generateNovelties'])->middleware('auth')->name('reports.novelty');
Route::post('/reports/vehicleLog', [ReportController::class, 'generateVehicleLog'])->middleware('auth')->name('reports.vehicleLog');
Route::post('/reports/civilianLog', [ReportController::class, 'generateCivilianLog'])->middleware('auth')->name('reports.civilianLog');
Route::post('/reports/pass/{id}', [ReportController::class, 'imprimirSalvocunducto'])->middleware('auth')->name('reports.pass');
/****************** FIN RUTAS PARA REPORTES ****************/


Auth::routes();


