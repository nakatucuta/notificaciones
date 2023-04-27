<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::delete('/home/{id}', 'App\Http\Controllers\HomeController@destroy')->name('home.delete');

Route::get('/enviar-mensaje', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('/enviar-mensaje', [App\Http\Controllers\HomeController::class, 'enviarMensaje']);