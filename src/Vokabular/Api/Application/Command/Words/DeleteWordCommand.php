<?php

namespace App\Vokabular\Api\Application\Command\Words;

use App\Vokabular\Api\Shared\Domain\Bus\Command\Command;

class DeleteWordCommand implements Command
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}