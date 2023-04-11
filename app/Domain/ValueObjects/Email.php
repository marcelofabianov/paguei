<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

final readonly class Email
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->getValue() === $other->getValue();
    }

    public static function random(): self
    {
        return self::create(fake()->email());
    }

    public static function isValid(string $email): bool
    {
        if (filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

    public static function create(mixed $value): self
    {
        if (! is_string($value) || ! self::isValid($value)) {
            throw new InvalidArgumentException('Email is invalid! Please provide a valid email address.');
        }

        return new self($value);
    }
}
