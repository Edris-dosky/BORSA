<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CurrencyExchangeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::resource('/currecy', CurrencyController::class)->except(['edit','create'])->names('currency');
    Route::resource('/client' , ClientController::class)->names('client');
    Route::resource('/exchange' , CurrencyExchangeController::class)->names('exchange');
    Route::get('/users', [RegisteredUserController::class, 'create'])->name('users');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

    
    

});


require __DIR__.'/auth.php';
