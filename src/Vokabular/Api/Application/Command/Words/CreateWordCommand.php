<?php

namespace App\Vokabular\Api\Application\Command\Words;

use App\Vokabular\Api\Shared\Domain\Bus\Command\Command;

class CreateWordCommand implements Command
{

    public function __construct(
        private string $word,
        private string $image,
        private string $gender,
        private string $level,
        private string $category
    )
    {
    }

    public function word(): string
    {
        return $this->word;
    }

    public function image(): string
    {
        return $this->image;
    }

    public function gender(): string
    {
        return $this->gender;
    }

    public function level(): string
    {
        return $this->level;
    }

    public function category(): string
    {
        return $this->category;
    }

}