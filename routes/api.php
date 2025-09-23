<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\DealController;
use App\Http\Controllers\Api\InteractionController;
use App\Http\Controllers\Api\AuthController;

// Authentication routes (public) with strict rate limiting
Route::middleware('throttle:5,1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});


// Protected routes (require authentication) with moderate rate limiting
Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    // User management
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Token management with stricter rate limiting
    Route::middleware('throttle:10,1')->group(function () {
        Route::post('/tokens', [AuthController::class, 'createToken']);
        Route::get('/tokens', [AuthController::class, 'tokens']);
        Route::delete('/tokens/{tokenId}', [AuthController::class, 'revokeToken']);
    });

    // Companies API
    Route::get('companies', [CompanyController::class, 'index']);
    Route::post('companies', [CompanyController::class, 'store']);
    Route::get('companies/{company}', [CompanyController::class, 'show']);
    Route::put('companies/{company}', [CompanyController::class, 'update']);
    Route::delete('companies/{company}', [CompanyController::class, 'destroy']);

    // Deals API
    Route::get('deals', [DealController::class, 'index']);
    Route::post('deals', [DealController::class, 'store']);
    Route::get('deals/{deal}', [DealController::class, 'show']);
    Route::put('deals/{deal}', [DealController::class, 'update']);
    Route::delete('deals/{deal}', [DealController::class, 'destroy']);

    // Interactions API
    Route::get('interactions', [InteractionController::class, 'index']);
    Route::post('interactions', [InteractionController::class, 'store']);
    Route::get('interactions/{interaction}', [InteractionController::class, 'show']);
    Route::put('interactions/{interaction}', [InteractionController::class, 'update']);
    Route::delete('interactions/{interaction}', [InteractionController::class, 'destroy']);

    // Dashboard Stats API
    Route::get('stats', function () {
        $user = Auth::user();
        if (!$user || !$user->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        return response()->json([
            'companies' => \App\Models\Company::where('id', $user->company_id)->count(),
            'deals' => \App\Models\Deal::where('company_id', $user->company_id)->count(),
            'interactions' => \App\Models\Interaction::where('company_id', $user->company_id)->count(),
            'users' => \App\Models\User::where('company_id', $user->company_id)->count(),
            'total_deal_value' => \App\Models\Deal::where('company_id', $user->company_id)->sum('value'),
            'recent_companies' => \App\Models\Company::where('id', $user->company_id)->latest()->take(5)->get(),
            'recent_deals' => \App\Models\Deal::where('company_id', $user->company_id)->latest()->take(5)->get(),
        ]);
    });
    
    // Dashboard Recent Activities API
    Route::get('recent-activities', function () {
        $user = Auth::user();
        if (!$user || !$user->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $recentInteractions = \App\Models\Interaction::where('company_id', $user->company_id)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($interaction) {
                return [
                    'id' => $interaction->id,
                    'type' => $interaction->type,
                    'notes' => $interaction->notes,
                    'time_ago' => $interaction->created_at->diffForHumans()
                ];
            });
            
        return response()->json([
            'activities' => $recentInteractions
        ]);
    });
    
    // Dashboard Stats API
    Route::get('dashboard-stats', function () {
        $user = Auth::user();
        if (!$user || !$user->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        // Calculate stats similar to the dashboard controller
        $companyId = $user->company_id;
        
        $totalCompanies = \App\Models\Company::where('id', $companyId)->count();
        $totalDeals = \App\Models\Deal::where('company_id', $companyId)->count();
        $totalRevenue = \App\Models\Deal::where('company_id', $companyId)->sum('value');
        
        // Simple conversion rate calculation
        $wonDeals = \App\Models\Deal::where('company_id', $companyId)
            ->where('stage', 'closed-won')
            ->count();
        $conversionRate = $totalDeals > 0 ? round(($wonDeals / $totalDeals) * 100, 1) : 0;
        
        return response()->json([
            'stats' => [
                'total_companies' => $totalCompanies,
                'total_deals' => $totalDeals,
                'total_revenue' => number_format($totalRevenue),
                'conversion_rate' => $conversionRate
            ]
        ]);
    });
});