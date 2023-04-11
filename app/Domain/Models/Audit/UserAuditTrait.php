<?php

declare(strict_types=1);

namespace App\Domain\Models\Audit;

use stdClass;

trait UserAuditTrait
{
    public function auditData(?stdClass $data = null): array
    {
        $user = $data ?? $this;

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'createdAt' => $user->createdAt,
            'updatedAt' => $user->updatedAt,
            'deletedAt' => $user->deletedAt,
        ];
    }
}
