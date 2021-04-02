<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Models\Client;
use App\Mail\ApprovedClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

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

Route::get('/', function () { return view('welcome');})->name('welcome');



//----------------------------USERS-------------------------------------------------------------------------------//
Route::group(['middleware' => ['auth',"forbid-banned-user",'role']], function () {
    Route::get('/users',[UserController::class, 'index'])->name('users.index');//Middleware set as example to restrict access for banned accounts
    Route::get('/users/list', [UserController::class, 'getUsers'])->name('users.list');
    Route::get('/users/create',[UserController::class, 'create'])->name('users.create');
    Route::post('/users/store',[UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit',[UserController::class , 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/ban',[UserController::class, 'ban'])->name('users.ban');
    Route::post('/users/unban',[UserController::class, 'unban'])->name('users.unban');
    Route::delete('/users/unApproveClient/{client}',[UserController::class, 'unapproveClient'])->name('users.unapproveClient');

});




Route::get('/users/login',[UserController::class, 'login'])->name('users.login');
Route::post('/users/authenticate',[UserController::class,'authenticate'])->name('users.authenticate');
Route::get('/nonapproved/list', [UserController::class, 'getNonApprovedClients'])->name('nonapproved.list');
Route::get('/approved/list', [UserController::class, 'getApprovedClients'])->name('approved.list');// response to ajax requests
Route::get('/users/listUnApprovedClients',[UserController::class, 'getNonApprovedClientsView'])->name('users.nonApprovedClients'); //list Non approved clients
Route::get('/users/listApprovedClients',[UserController::class, 'getGetApprovedClientsView'])->name('users.ApprovedClients'); //list approved clients
Route::get('/users/{client}/approveClient',[UserController::class, 'approveClient'])->name('users.approveClient'); //change non approved clients to approved





//----------------------------USERS-------------------------------------------------------------------------------//

//----------------------------FLOORS-------------------------------------------------------------------------------//

Route::group(['middleware' => ['auth','role']], function () {
    Route::get('/floors',[FloorController::class,'index'])->name('floors.index');
    Route::get('/floors/create',[FloorController::class,'create'])->name('floors.create');
    Route::post('/floors/store',[FloorController::class,'store'])->name('floors.store');
    Route::get('/floors/{floor}/edit',[FloorController::class , 'edit'])->name('floors.edit');
    Route::put('/floors/{floor}', [FloorController::class, 'update'])->name('floors.update');
    Route::delete('/floors/{floor}', [FloorController::class, 'destroy'])->name('floors.destroy');
    Route::get('/floors/list', [FloorController::class, 'getfloor'])->name('floors.list');
});




//----------------------------FLOORS-------------------------------------------------------------------------------//

//----------------------------ROOMS-------------------------------------------------------------------------------//
Route::group(['middleware' => ['auth','role']], function () {
    Route::get('/rooms',[RoomController::class,'index'])->name('rooms.index');
    Route::get('/rooms/create',[RoomController::class,'create'])->name('rooms.create');
    Route::post('/rooms/store',[RoomController::class,'store'])->name('rooms.store');
    Route::get('/rooms/{room}/edit',[RoomController::class , 'edit'])->name('rooms.edit');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    Route::get('/rooms/list', [RoomController::class, 'getRoom'])->name('rooms.list');
});
//----------------------------ROOMS-------------------------------------------------------------------------------//


//----------------------------CLIENTS-------------------------------------------------------------------------------//

Route::get('/clients',[ClientController::class , 'index'])->name('clients.index')->middleware('clientAuth');
Route::get('/clients/create/{room}',[ClientController::class,'create'])->name('reservations.create')->middleware('clientAuth');
Route::get('/clients/reservations',[ClientController::class,'reservation'])->name('rooms.reservation')->middleware('clientAuth');
Route::post('/clients/store',[ClientController::class,'store'])->name('reservations.store')->middleware('clientAuth');
Route::post('/clients/authenticate',[ClientController::class,'authenticate'])->name('clients.authenticate');
Route::post('/clients/register',[ClientController::class,'register'])->name('clients.register');
Route::get('/clients/reservations/list', [ClientController::class, 'getReservation'])->name('reservations.list')->middleware('clientAuth');
Route::get('/clients/reservations/getRooms', [ClientController::class, 'getRooms'])->name('Rooms.list')->middleware('clientAuth');

Auth::routes();

//----------------------------CLIENTS-------------------------------------------------------------------------------//

//---------------------- edit profile -----------------------------------------//

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profiles/{profile}', [ProfileController::class, 'update'])->name('profile.update');

//------------------------checkout---------------------------------------------//

Route::get('checkout',[App\Http\Controllers\CheckoutController::class, 'checkout'])->name('clients.checkout');
Route::post('checkout',[App\Http\Controllers\CheckoutController::class, 'afterPayment'])->name('checkout.credit-card');


//------------------------reservations---------------------------------------------//
Route::get('reservations',[App\Http\Controllers\ReservationController::class, 'index'])->name('user.reservations')->middleware('auth');;
Route::get('reservations/list',[App\Http\Controllers\ReservationController::class, 'getReservation'])->name('reservations.list.ajax')->middleware('auth');;





