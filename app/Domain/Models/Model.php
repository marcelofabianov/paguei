<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\ValueObjects\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Model extends Eloquent
{
    use HasUuids;
    use Notifiable;
    use SoftDeletes;

    public const CREATED_AT = 'createdAt';

    public const UPDATED_AT = 'updatedAt';

    public const DELETED_AT = 'deletedAt';

    public $incrementing = false;

    protected $perPage = 200;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public function newUniqueId(): string
    {
        return Uuid::random()->getValue();
    }

    public function uniqueIds(): array
    {
        return ['id'];
    }
}
