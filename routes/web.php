<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoveltyController;
use App\Http\Controllers\PendingTaskController;



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

Auth::routes();


