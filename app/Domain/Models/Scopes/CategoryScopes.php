<?php

declare(strict_types=1);

namespace App\Domain\Models\Scopes;

use App\Domain\ValueObjects\Uuid;
use Illuminate\Database\Eloquent\Builder;

trait CategoryScopes
{
    public function scopeOrderByName(Builder $query): Builder
    {
        return $query->orderBy('name');
    }

    public function scopeWhereCreator(Builder $query, Uuid $userId): Builder
    {
        return $query->where('userId', $userId->getValue());
    }

    public function scopeWhereCategoryAndCreator(Builder $query, Uuid $categoryId, Uuid $userId): Builder
    {
        return $query
            ->where('id', $categoryId->getValue())
            ->where('userId', $userId->getValue());
    }
}
