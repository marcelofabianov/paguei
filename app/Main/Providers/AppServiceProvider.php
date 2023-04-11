<?php

declare(strict_types=1);

namespace App\Main\Providers;

use App\Main\MainContainer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $main = new MainContainer();
        $main->register();
    }

    public function boot(): void
    {
    }
}
