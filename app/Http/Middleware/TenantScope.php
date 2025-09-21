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
        if ($request->route('company') && $request->route('company')->id !== $companyId) {
            // Don't allow access to other companies
            abort(403, 'Unauthorized action.');
        }

        if ($request->route('deal') && $request->route('deal')->company_id !== $companyId) {
            // Don't allow access to deals from other companies
            abort(403, 'Unauthorized action.');
        }

        if ($request->route('contact') && $request->route('contact')->company_id !== $companyId) {
            // Don't allow access to contacts from other companies
            abort(403, 'Unauthorized action.');
        }

        if ($request->route('interaction') && $request->route('interaction')->company_id !== $companyId) {
            // Don't allow access to interactions from other companies
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}