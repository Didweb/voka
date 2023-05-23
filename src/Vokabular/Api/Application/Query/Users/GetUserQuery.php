<?php

namespace App\Vokabular\Api\Application\Query\Users;

use App\Vokabular\Api\Shared\Domain\Bus\Query\Query;

class GetUserQuery implements Query
{

    public function __construct(private string $email)
    {
    }

    public function email(): string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email()
        ];
    }
}