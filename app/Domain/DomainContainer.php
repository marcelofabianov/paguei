<?php

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
