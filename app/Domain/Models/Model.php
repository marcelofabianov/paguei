<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\ValueObjects\Uuid;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $id
 * @property DateTimeInterface $inactivatedAt
 * @property DateTimeInterface $createdAt
 * @property DateTimeInterface $updatedAt
 * @property DateTimeInterface $deletedAt
 */
class Model extends Eloquent
{
    use HasUuids;
    use Notifiable;
    use SoftDeletes;

    public const CREATED_AT = 'createdAt';

    public const UPDATED_AT = 'updatedAt';

    public const DELETED_AT = 'deletedAt';

    public $incrementing = false;

    protected $perPage = 50;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $hidden = [
        'deletedAt',
    ];

    public function newUniqueId(): string
    {
        return Uuid::random()->getValue();
    }

    public function uniqueIds(): array
    {
        return ['id'];
    }
}
