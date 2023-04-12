<?php

declare(strict_types=1);

namespace App\Domain\Models\Scopes;

use App\Domain\ValueObjects\Uuid;
use Illuminate\Database\Eloquent\Builder;

trait CategoryScopes
{
    public function scopeWhereCategoryAndCreator($query, Uuid $categoryId, Uuid $userId): Builder
    {
        return $query
            ->where('id', $categoryId->getValue())
            ->where('userId', $userId->getValue());
    }
}
