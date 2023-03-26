<?php

declare(strict_types=1);

namespace App\Domain;

final class DomainContainer
{
    public function register(): void
    {
        $this->observers();
    }

    public function observers(): void
    {
        //
    }
}
