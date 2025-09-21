<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\DealController;
use App\Http\Controllers\Api\InteractionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Companies API - Requires authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('companies', [CompanyController::class, 'index']);
    Route::post('companies', [CompanyController::class, 'store']);
    Route::get('companies/{company}', [CompanyController::class, 'show']);
    Route::put('companies/{company}', [CompanyController::class, 'update']);
    Route::delete('companies/{company}', [CompanyController::class, 'destroy']);

    // Deals API
    Route::get('deals', [DealController::class, 'index']);
    Route::post('deals', [DealController::class, 'store']);
    Route::get('deals/{deal}', [DealController::class, 'show']);

    // Interactions API
    Route::get('interactions', [InteractionController::class, 'index']);
    Route::post('interactions', [InteractionController::class, 'store']);

    // Dashboard Stats API
    Route::get('stats', function () {
        $user = Auth::user();
        if (!$user || !$user->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        return response()->json([
            'companies' => \App\Models\Company::count(),
            'deals' => \App\Models\Deal::count(),
            'interactions' => \App\Models\Interaction::count(),
            'users' => \App\Models\User::where('company_id', $user->company_id)->count(),
            'total_deal_value' => \App\Models\Deal::sum('value'),
            'recent_companies' => \App\Models\Company::latest()->take(5)->get(),
            'recent_deals' => \App\Models\Deal::latest()->take(5)->get(),
        ]);
    });
});

// Protected API endpoints (require authentication in production)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::put('companies/{company}', [CompanyController::class, 'update'])->name('api.companies.update');
    Route::delete('companies/{company}', [CompanyController::class, 'destroy'])->name('api.companies.destroy');
});