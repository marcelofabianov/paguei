<?php

declare(strict_types=1);

namespace App\Consumers\Customers\Dto;

use App\Domain\ValueObjects\Uuid;
use App\Main\Helpers\ToArrayTrait;

final readonly class UpdateCategoryDto
{
    use ToArrayTrait;

    public ?\DateTimeInterface $inactivatedAt;

    public function __construct(
        public Uuid $categoryId,
        public Uuid $userId,
        public string $name,
        bool $inactivated,
    ) {
        $this->inactivatedAt = $inactivated ? now() : null;
    }
}
