<?php

declare(strict_types=1);

namespace App\Domain\Enums;

enum AuditEventTypeEnum: string
{
    case CREATED = 'CREATED';

    case UPDATING = 'UPDATING';

    case DELETED = 'DELETED';

    case RESTORED = 'RESTORED';
}
