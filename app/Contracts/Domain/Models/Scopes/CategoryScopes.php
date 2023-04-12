<?php

declare(strict_types=1);

namespace App\Contracts\Domain\Models\Scopes;

use App\Domain\ValueObjects\Uuid;
use Illuminate\Database\Eloquent\Builder;

interface CategoryScopes
{
    public function scopeWhereCategoryAndCreator($query, Uuid $categoryId, Uuid $userId): Builder;
}
