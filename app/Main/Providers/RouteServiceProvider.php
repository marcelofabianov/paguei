<?php

namespace App\Main\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/';

    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            $this->public();
            $this->api();
            $this->web();
        });
    }

    public function public(): void
    {
        Route::middleware([
            'web',
            //'scope:public'
        ])
            ->as('web.')
            ->group(fn() => Route::get('/', fn() => ':D'));
    }

    public function api(): void
    {
        Route::middleware([
            'api',
            //'auth.api',
            //'scope:administrators'
        ])
            ->prefix('api/administrators/v1')
            ->as('api.administrators.')
            ->group(app_path('Consumers/Administrators/Http/routes.php'));

        Route::middleware([
            'api',
            //'auth.api',
            //'scope:customers'
        ])
            ->prefix('api/customers/v1')
            ->as('api.customers.')
            ->group(app_path('Consumers/Customers/Http/routes.php'));
    }

    public function web(): void
    {
        Route::middleware([
            'web',
            //'auth:web',
            //'scope:web'
        ])
            ->as('web.')
            ->group(fn() => Route::get('/', fn() => 'Hi!'));
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
