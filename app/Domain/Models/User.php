<?php

declare(strict_types=1);

namespace App\Domain\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Domain\Enums\UserRoleEnum;
use App\Domain\Models\Audit\UserAuditTrait;
use App\Domain\Models\Casts\EmailCast;
use App\Domain\Models\Scopes\InactivatedAtScope;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Uuid;
use Database\Factories\UserFactory;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * @property string $id
 * @property string $name
 * @property Email $email
 * @property string $password
 * @property UserRoleEnum $role
 * @property DateTimeInterface|null $inactivatedAt
 * @property DateTimeInterface $createdAt
 * @property DateTimeInterface $updatedAt
 * @property DateTimeInterface|null $deletedAt
 */
final class User extends Authenticatable
{
    use HasApiTokens;
    use HasUuids;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use InactivatedAtScope;
    use UserAuditTrait;

    public const CREATED_AT = 'createdAt';

    public const UPDATED_AT = 'updatedAt';

    public const DELETED_AT = 'deletedAt';

    public $incrementing = false;

    protected $table = 'users';

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'inactivatedAt',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'inactivatedAt' => 'datetime',
        'role' => UserRoleEnum::class,
        'email' => EmailCast::class,
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
