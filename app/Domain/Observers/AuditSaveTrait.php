<?php

declare(strict_types=1);

namespace App\Domain\Observers;

use App\Domain\Enums\AuditEventTypeEnum;
use App\Domain\Models\Audit;
use App\Domain\ValueObjects\Json;
use App\Domain\ValueObjects\Uuid;

trait AuditSaveTrait
{
    public function auditSave(AuditEventTypeEnum $event, Uuid $target, Json|null $before, Json|null $after): void
    {
        if (auth()->check()) {
            Audit::create([
                'target' => $target->getValue(),
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'model' => $this->model,
                'event' => $event->value,
                'before' => is_null($before) ? null : $before->getValue(),
                'after' => is_null($after) ? null : $after->getValue(),
            ]);
        }
    }
}
