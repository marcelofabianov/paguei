<?php

declare(strict_types=1);

namespace App\Main\Helpers;

trait ToArrayTrait
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
