<?php

declare(strict_types=1);

namespace App\Main\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/';

    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function (): void {
            $this->public();
            $this->api();
            $this->web();
        });
    }

    public function public(): void
    {
        Route::middleware(['web'])
            ->group(function (): void {
                Route::get('/', fn () => '...');
                Route::get('/login', fn () => '...')->name('login');
            });
    }

    public function api(): void
    {
        Route::middleware([
            'api',
            'json.response',
            'auth:api',
            'role:administrator',
            'scope:adm',
        ])
            ->prefix('api/adm/v1')
            ->as('api.adm.')
            ->group(app_path('Consumers/Administrators/Http/routes.php'));

        Route::middleware([
            'api',
            'json.response',
            'auth:api',
            'role:customer',
            'scope:customers',
        ])
            ->prefix('api/v1')
            ->as('api.customers.')
            ->group(app_path('Consumers/Customers/Http/routes.php'));
    }

    public function web(): void
    {
        Route::middleware([
            'web',
            'auth:web',
        ])
            ->as('web.')
            ->group(fn () => Route::get('/web', fn () => 'Hi!'));
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
