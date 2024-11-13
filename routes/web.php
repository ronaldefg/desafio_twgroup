<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\AdminReservationController;
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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('rooms', RoomController::class);
    Route::get('admin/reservations', [AdminReservationController::class, 'index'])->name('admin.reservations.index');
    Route::post('admin/reservations/{reservation}/status', [AdminReservationController::class, 'updateStatus'])->name('admin.reservations.updateStatus');
});

Route::middleware(['auth'])->group(function () {
    Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('rooms/{room}/reserve', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('rooms/{room}/reserve', [ReservationController::class, 'store'])->name('reservations.store');
});
