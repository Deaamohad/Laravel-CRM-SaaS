<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\Deal;
use App\Models\Interaction;
use App\Models\Contact;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TenantScope
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        $companyId = $user->company_id;

        // Check if the user is trying to access a specific resource
        if ($request->route('company')) {
            $company = $request->route('company');
            
            // Allow access if:
            // 1. User created the company, OR
            // 2. User belongs to the company
            if (($company->user_id !== null && $company->user_id !== $user->id) && 
                ($companyId !== null && $company->id !== $companyId)) {
                abort(403, 'Unauthorized action.');
            }
        }

        if ($request->route('deal')) {
            $deal = $request->route('deal');
            
            // Allow access if:
            // 1. User created the deal, OR
            // 2. User belongs to the company that owns the deal
            if (($deal->user_id !== null && $deal->user_id !== $user->id) && 
                ($companyId !== null && $deal->company_id !== $companyId)) {
                abort(403, 'Unauthorized action.');
            }
        }

        if ($request->route('contact') && $request->route('contact')->company_id !== null && 
            $companyId !== null && $request->route('contact')->company_id !== $companyId) {
            // Don't allow access to contacts from other companies
            abort(403, 'Unauthorized action.');
        }

        if ($request->route('interaction')) {
            $interaction = $request->route('interaction');
            
            // Allow access if:
            // 1. User created the interaction, OR
            // 2. User belongs to the company that owns the interaction
            if (($interaction->user_id !== null && $interaction->user_id !== $user->id) && 
                ($companyId !== null && $interaction->company_id !== $companyId)) {
                abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }
}