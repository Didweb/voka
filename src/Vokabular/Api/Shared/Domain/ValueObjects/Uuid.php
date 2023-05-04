<?php

namespace App\Vokabular\Api\Shared\Domain\ValueObjects;


use App\Vokabular\Api\Shared\Domain\ValueObjects\Exception\UuidValueException;

class Uuid
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    /** @return static */
    public static function create(string $uuid)
    {
        if (!\Ramsey\Uuid\Nonstandard\Uuid::isValid($uuid)) {
            throw UuidValueException::notValid($uuid);
        }

        return new static($uuid);
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}