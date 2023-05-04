<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Command\Categories;

use App\Vokabular\Frontend\Shared\Domain\Bus\Command\Command;

class EditCategoryCommand implements Command
{

    public function __construct(
        private string $id,
        private string $name,
        private \DateTime $createAt,
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

    public function createAt(): \DateTime
    {
        return $this->createAt;
    }

}