<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/* Route::post('/registerclient', [App\Http\Controllers\ClientController::class, 'store'])->name('create'); */

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users',[UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::get('/users/login',[UserController::class, 'login'])->name('users.login');
Route::get('/users/list', [UserController::class, 'getUsers'])->name('users.list'); // response to ajax requests
Route::get('/users/create',[UserController::class, 'create'])->name('users.create');
Route::post('/users/store',[UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit',[UserController::class , 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/users/authenticate',[UserController::class,'authenticate'])->name('users.authenticate');



Route::get('/clients',[ClientController::class , 'index'])->name('clients.index')->middleware('clientAuth');
Route::post('/clients/authenticate',[ClientController::class,'authenticate'])->name('clients.authenticate');
Auth::routes();

