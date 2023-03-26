<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Enums\AuditEventTypeEnum;
use App\Domain\Models\Casts\EmailCast;
use App\Domain\Models\Casts\JsonCast;
use App\Domain\Models\Casts\UuidCast;

final class Audit extends Model
{
    protected $table = 'audits';

    protected $fillable = [
        'target',
        'name',
        'email',
        'model',
        'event',
        'before',
        'after',
    ];

    protected $casts = [
        'target' => UuidCast::class,
        'email' => EmailCast::class,
        'event' => AuditEventTypeEnum::class,
        'before' => JsonCast::class,
        'after' => JsonCast::class,
    ];
}
