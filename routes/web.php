<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/pricing', fn() => view('pages.pricing'))->name('pricing');
Route::get('/contact', fn() => view('pages.contact'))->name('contact');
Route::get('/about', fn() => view('pages.about'))->name('about');

// Development: Dashboard without auth (remove auth later)
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Quick Action Routes (for modal AJAX submissions)
Route::post('companies/quick-add', [DashboardController::class, 'quickAddCompany'])->name('companies.quick-add');
Route::post('deals/quick-create', [DashboardController::class, 'quickCreateDeal'])->name('deals.quick-create');
Route::post('interactions/quick-log', [DashboardController::class, 'quickLogInteraction'])->name('interactions.quick-log');

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

