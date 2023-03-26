<?php

declare(strict_types=1);

namespace App\Domain\Models\Casts;

use App\Domain\ValueObjects\Uuid;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

final class UuidCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_a($value, Uuid::class)) {
            return $value;
        }

        return Uuid::create($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (is_a($value, Uuid::class)) {
            return $value->getValue();
        }

        return Uuid::create($value)->getValue();
    }
}
