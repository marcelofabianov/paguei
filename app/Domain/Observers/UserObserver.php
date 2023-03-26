<?php

declare(strict_types=1);

namespace App\Domain\Observers;

use App\Domain\Models\User;

final class UserObserver
{
    private string $model = User::class;

    public function created(User $user): void
    {
        //
    }

    public function updating(User $user): void
    {
        //
    }

    public function deleted(User $user): void
    {
        //
    }

    public function restored(User $user): void
    {
        //
    }
}
