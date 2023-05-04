<?php

namespace App\Vokabular\Api\Application\Command\Categories;

use App\Vokabular\Api\Shared\Domain\Bus\Command\Command;

final class CreateCategoryCommand implements Command
{

    public function __construct(private string $name)
    {
    }

    public function name(): string
    {
        return $this->name;
    }

}