<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\InteractionsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SearchController;
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
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('deals', [DealsController::class, 'index'])->name('deals.index');
    Route::get('interactions', [InteractionsController::class, 'index'])->name('interactions.index');
    Route::get('reports', [DashboardController::class, 'reports'])->name('reports.index');
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('api-management', [ApiManagementController::class, 'index'])->name('api.management');
    Route::get('api-guide', fn() => view('api.integration-guide'))->name('api.guide');

    // Settings Routes
    Route::post('settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('settings/reset-data', [SettingsController::class, 'resetData'])->name('settings.reset-data');
    Route::post('settings/delete-account', [SettingsController::class, 'deleteAccount'])->name('settings.delete-account');

    // Company CRUD Routes
    Route::post('companies', [CompaniesController::class, 'store'])->name('companies.store');
    Route::post('companies/quick-add', [DashboardController::class, 'quickAddCompany'])->name('companies.quick-add');
    Route::get('companies/{company}', [CompaniesController::class, 'show'])->name('companies.show');
    Route::put('companies/{company}', [CompaniesController::class, 'update'])->name('companies.update');
    Route::delete('companies/{company}', [CompaniesController::class, 'destroy'])->name('companies.destroy');

    // Contact CRUD Routes
    Route::post('contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::put('contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

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

    // Search Routes
    Route::get('search/global', [SearchController::class, 'global'])->name('search.global');
    Route::get('search/companies', [SearchController::class, 'companies'])->name('search.companies');
    Route::get('search/contacts', [SearchController::class, 'contacts'])->name('search.contacts');
    Route::get('search/deals', [SearchController::class, 'deals'])->name('search.deals');
    Route::get('search/interactions', [SearchController::class, 'interactions'])->name('search.interactions');
});

