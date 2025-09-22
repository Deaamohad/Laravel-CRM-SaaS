<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\InteractionsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ApiManagementController;

// Public routes (available to guests)
Route::get('/', function () {
    // Redirect authenticated users to dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('pages.home');
})->name('home');

Route::get('/pricing', function() {
    // Redirect authenticated users to dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('pages.pricing');
})->name('pricing');

Route::get('/contact', function() {
    // Redirect authenticated users to dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('pages.contact');
})->name('contact');

Route::get('/about', function() {
    // Redirect authenticated users to dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('pages.about');
})->name('about');

// Authentication Routes (for guests only)
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

// Authenticated routes (requires login)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // CRM Pages
    Route::get('companies', [CompaniesController::class, 'index'])->name('companies.index');
    Route::get('all-companies', [DashboardController::class, 'allCompanies'])->name('companies.all');
    Route::get('deals', [DealsController::class, 'index'])->name('deals.index');
    Route::get('interactions', [InteractionsController::class, 'index'])->name('interactions.index');
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('api-management', [ApiManagementController::class, 'index'])->name('api.management');
    Route::get('api-guide', fn() => view('api.integration-guide'))->name('api.guide');

    // Settings Routes
    Route::post('settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    Route::post('settings/reset-data', [SettingsController::class, 'resetData'])->name('settings.reset-data');
    Route::post('settings/delete-account', [SettingsController::class, 'deleteAccount'])->name('settings.delete-account');

    // Company CRUD Routes
    Route::post('companies', [CompaniesController::class, 'store'])->name('companies.store');
    Route::post('companies/quick-add', [DashboardController::class, 'quickAddCompany'])->name('companies.quick-add');
    Route::get('companies/{company}', [CompaniesController::class, 'show'])->name('companies.show');
    Route::get('companies/{company}/edit', [CompaniesController::class, 'edit'])->name('companies.edit');
    Route::put('companies/{company}', [CompaniesController::class, 'update'])->name('companies.update');
    Route::delete('companies/{company}', [CompaniesController::class, 'destroy'])->name('companies.destroy');

    // Deal CRUD Routes
    Route::post('deals', [DealsController::class, 'store'])->name('deals.store');
    Route::post('deals/quick-create', [DashboardController::class, 'quickCreateDeal'])->name('deals.quick-create');
    Route::get('deals/{deal}', [DealsController::class, 'show'])->name('deals.show');
    Route::put('deals/{deal}', [DealsController::class, 'update'])->name('deals.update');
    Route::delete('deals/{deal}', [DealsController::class, 'destroy'])->name('deals.destroy');

    // Interaction CRUD Routes
    Route::post('interactions', [InteractionsController::class, 'store'])->name('interactions.store');
    Route::post('interactions/quick-log', [DashboardController::class, 'quickLogInteraction'])->name('interactions.quick-log');
    Route::get('interactions/{interaction}', [InteractionsController::class, 'show'])->name('interactions.show');
    Route::put('interactions/{interaction}', [InteractionsController::class, 'update'])->name('interactions.update');
    Route::delete('interactions/{interaction}', [InteractionsController::class, 'destroy'])->name('interactions.destroy');
});