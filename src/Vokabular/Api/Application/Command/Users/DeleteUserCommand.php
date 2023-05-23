<?php

namespace App\Vokabular\Api\Application\Command\Users;

use App\Vokabular\Api\Shared\Domain\Bus\Command\Command;

class DeleteUserCommand implements Command
{

    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }

}