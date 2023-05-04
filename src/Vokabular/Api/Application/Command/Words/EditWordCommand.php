<?php

namespace App\Vokabular\Api\Application\Command\Words;

use App\Vokabular\Api\Shared\Domain\Bus\Command\Command;
use DateTime;

class EditWordCommand implements Command
{
    public function __construct(
        private string $id,
        private string $word,
        private string $gender,
        private string $level,
        private string $category
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function word(): string
    {
        return $this->word;
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