<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Models\Scopes\InactivatedAtScope;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Category extends Model
{
    use HasFactory;
    use InactivatedAtScope;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'inactivatedAt',
    ];

    protected function newFactory(): CategoryFactory
    {
        return new CategoryFactory();
    }
}
