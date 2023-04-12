<?php

declare(strict_types=1);

namespace App\Contracts\Domain\Models\Scopes;

use App\Domain\ValueObjects\Uuid;
use Illuminate\Database\Eloquent\Builder;

interface CategoryScopes
{
    public function scopeOrderByName(Builder $query): Builder;

    public function scopeWhenActive(Builder $query): Builder;

    public function scopeWhenInactivated(Builder $query): Builder;

    public function scopeWhereCreator(Builder $query, Uuid $userId): Builder;

    public function scopeWhereCategoryAndCreator(Builder $query, Uuid $categoryId, Uuid $userId): Builder;
}
