<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Contracts\Domain\Models\Scopes\CategoryScopes as CategoryScopesContract;
use App\Domain\Models\Casts\UuidCast;
use App\Domain\Models\Scopes\CategoryScopes;
use App\Domain\Models\Scopes\InactivatedAtScopes;
use App\Domain\ValueObjects\Uuid;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property Uuid $userId
 * @property string $name
 * @property bool $public
 *
 * @method whereCategoryAndCreator(Uuid $categoryId, Uuid $userId)
 */
final class Category extends Model implements CategoryScopesContract
{
    use HasFactory;
    use InactivatedAtScopes;
    use CategoryScopes;

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
