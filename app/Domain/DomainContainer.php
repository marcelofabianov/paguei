<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Models\User;
use App\Domain\Observers\UserObserver;

final class DomainContainer
{
    public function register(): void
    {
    }

    public function observers(): void
    {
        User::observe(UserObserver::class);
    }
}
