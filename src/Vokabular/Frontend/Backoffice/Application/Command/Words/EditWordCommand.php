<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Command\Words;

use App\Vokabular\Frontend\Shared\Domain\Bus\Command\Command;

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