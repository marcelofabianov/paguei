<?php

declare(strict_types=1);

namespace App\Consumers\Customers\Dto;

use App\Domain\ValueObjects\Uuid;
use App\Main\Helpers\ToArrayTrait;

final readonly class CreateCategoryDto
{
    use ToArrayTrait;

    public ?\DateTimeInterface $inactivatedAt;

    public false $public;

    public function __construct(
        public string $name,
        public Uuid $userId,
    ) {
        $this->inactivatedAt = null;
        $this->public = false;
    }
}
