<?php

namespace App\Vokabular\Api\Application\Command\Users;

use App\Vokabular\Api\Shared\Domain\Bus\Command\Command;

class CreateUserCommand implements Command
{
    public function __construct(
        private string  $name,
        private string  $email
    )
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }


}