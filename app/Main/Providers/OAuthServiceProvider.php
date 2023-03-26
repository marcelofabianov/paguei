<?php

declare(strict_types=1);

namespace App\Main\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class OAuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Passport::ignoreMigrations();
    }

    public function boot(): void
    {
        Passport::tokensExpireIn(now()->addHour());
        Passport::refreshTokensExpireIn(now()->addHours(3));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        Passport::tokensCan([
            'adm' => '',
            'customers' => '',
        ]);
    }
}
