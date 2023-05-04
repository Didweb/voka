<?php

namespace App\Vokabular\Api\Application\Command\Words;

use App\Vokabular\Api\Shared\Domain\Bus\Command\Command;

class ChangeImageWordCommand implements Command
{

    public function __construct(
        private string $id,
        private string $image,
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function image(): string
    {
        return $this->image;
    }

}