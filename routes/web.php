<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/adminView', function () {
    return view('admin');
})->middleware('auth');


Route::get('/uuu', [App\Http\Controllers\UserController::class, 'indexA'])->name('userIndex')->middleware('auth');

Auth::routes();


