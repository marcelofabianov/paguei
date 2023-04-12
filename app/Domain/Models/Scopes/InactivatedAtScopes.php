<?php

declare(strict_types=1);

namespace App\Domain\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait InactivatedAtScopes
{
    public function scopeWhenActive(Builder $query): Builder
    {
        return $query->whereNull('inactivatedAt');
    }

    public function scopeWhenInactivated(Builder $query): Builder
    {
        return $query->whereNotNull('inactivatedAt');
    }
}
