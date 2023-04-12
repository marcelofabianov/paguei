<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Models\Casts\UuidCast;
use App\Domain\Models\Scopes\CategoryScope;
use App\Domain\Models\Scopes\InactivatedAtScope;
use App\Domain\ValueObjects\Uuid;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property Uuid $userId
 * @property string $name
 * @property bool $public
 *
 * @method whereCreator(Uuid $categoryId, Uuid $userId)
 */
final class Category extends Model
{
    use HasFactory;
    use InactivatedAtScope;
    use CategoryScope;

    protected $table = 'categories';

    protected $fillable = [
        'userId',
        'name',
        'public',
        'inactivatedAt',
    ];

    protected $casts = [
        'userId' => UuidCast::class,
        'public' => 'boolean',
        'inactivatedAt' => 'datetime',
    ];

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }
}
