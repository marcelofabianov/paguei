<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

final readonly class Uuid implements \JsonSerializable, \Stringable
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

    public function version(): string
    {
        return 'UUID Version-4 RFC 4122';
    }

    public static function isValid(string $value): bool
    {
        return RamseyUuid::isValid($value);
    }

    public static function random(): self
    {
        return new self((string) RamseyUuid::uuid4());
    }

    public function jsonSerialize(): string
    {
        return $this->getValue();
    }

    public static function create(mixed $value): self
    {
        if (! is_string($value) || ! self::isValid($value)) {
            throw new InvalidArgumentException('UUID is invalid! Please provide a valid');
        }

        return new self($value);
    }
}
