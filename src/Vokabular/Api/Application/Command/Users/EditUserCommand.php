<?php

namespace App\Vokabular\Api\Application\Command\Users;

use App\Vokabular\Api\Shared\Domain\Bus\Command\Command;

class EditUserCommand implements Command
{

    public function __construct(
        private string $id,
        private string $name
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

}