<?php

namespace App\Vokabular\Api\Application\Command\Categories;

use App\Vokabular\Api\Shared\Domain\Bus\Command\Command;

class EditCategoryCommand implements Command
{

    public function __construct(
        private string $id,
        private string $name,
        private \DateTime $createdAt,
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

    public function createdAt(): \DateTime
    {
        return $this->createdAt;
    }

}