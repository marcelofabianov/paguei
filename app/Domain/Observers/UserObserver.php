<?php

declare(strict_types=1);

namespace App\Domain\Observers;

use App\Domain\Enums\AuditEventTypeEnum;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Json;
use App\Domain\ValueObjects\Uuid;

final class UserObserver
{
    use AuditSaveTrait;

    private string $model = User::class;

    public function created(User $user): void
    {
        $this->auditSave(
            event: AuditEventTypeEnum::CREATED,
            target: Uuid::create($user->id),
            before: null,
            after: Json::create($user->auditData()),
        );
    }

    public function updating(User $user): void
    {
        $this->auditSave(
            event: AuditEventTypeEnum::UPDATING,
            target: Uuid::create($user->id),
            before: Json::create($user->auditData($user->getOriginal())),
            after: Json::create($user->auditData()),
        );
    }

    public function deleted(User $user): void
    {
        $this->auditSave(
            event: AuditEventTypeEnum::DELETED,
            target: Uuid::create($user->id),
            before: null,
            after: Json::create($user->auditData()),
        );
    }

    public function restored(User $user): void
    {
        $this->auditSave(
            event: AuditEventTypeEnum::RESTORED,
            target: Uuid::create($user->id),
            before: null,
            after: Json::create($user->auditData()),
        );
    }
}
