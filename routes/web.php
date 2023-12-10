<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UsersController;

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
    return view('pages.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('rent-detail', [MoviesController::class, 'show'])->name('rentMovie');

    Route::post('confirm-order', [RentController::class, 'store'])->name('confirmOrder');

    Route::get('rent-list', [RentController::class, 'index'])->name('rentList');
    
    Route::get('delete-rent', [RentController::class, 'destroy'])->name('deleteRent');

    Route::get('/profile', [UsersController::class, 'index'])->name('profile');

    Route::post('/update-profile', [UsersController::class, 'update'])->name('updateProfile');
});

