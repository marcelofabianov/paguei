<?php

declare(strict_types=1);

namespace App\Domain\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Domain\Models\Audit\UserAuditTrait;
use App\Domain\Models\Scopes\InactivatedAtScope;
use App\Domain\ValueObjects\Uuid;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

final class User extends Authenticatable
{
    use HasApiTokens;
    use HasUuids;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use InactivatedAtScope;
    use UserAuditTrait;

    const CREATED_AT = 'createdAt';

    const UPDATED_AT = 'updatedAt';

    const DELETED_AT = 'deletedAt';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'inactivatedAt',
        'isAdministrator',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'inactivatedAt' => 'datetime',
        'isAdmin' => 'boolean',
    ];

    public function newUniqueId(): string
    {
        return Uuid::random()->getValue();
    }

    public function uniqueIds(): array
    {
        return ['id'];
    }

    protected static function newFactory(): UserFactory
    {
        return new UserFactory();
    }
}
