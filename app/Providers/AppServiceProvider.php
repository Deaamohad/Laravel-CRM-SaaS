<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TenantScope;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Schema;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->make(Router::class)->aliasMiddleware('tenant', TenantScope::class);
        
        Schema::defaultStringLength(191);

        // Apply the tenant middleware to web routes by default
        $this->app->make(Router::class)->pushMiddlewareToGroup('web', 'tenant');
    }
}
