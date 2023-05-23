<?php

namespace App\Vokabular\Api\Shared\Domain\ValueObjects;

use InvalidArgumentException;

final class Email
{

    public function __construct(private string $email)
    {
    }

    public static function createValidated(string $email): self
    {
        self::validate($email);
        return new self($email);
    }

    public static function create(string $email): self
    {
        return new self($email);
    }

    public static function validate(string $email): void
    {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf("Invalid email format <%s>", $email)
            );
        }
    }

    public function __toString()
    {
        return $this->email;
    }

}