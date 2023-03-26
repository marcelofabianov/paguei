<?php

declare(strict_types=1);

namespace App\Domain\Enums;

enum UserRoleEnum: string
{
    case Administrator = 'administrator';
    case Customer = 'customer';
}
