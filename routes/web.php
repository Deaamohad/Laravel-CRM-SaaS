<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('main');
})->name('home');

Route::get('/pricing', fn() => view('pricing'))->name('pricing');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::get('/about', fn() => view('about'))->name('about');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::apiResource('companies', CompanyController::class);

