<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Command\Words;

use App\Vokabular\Frontend\Shared\Domain\Bus\Command\Command;

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