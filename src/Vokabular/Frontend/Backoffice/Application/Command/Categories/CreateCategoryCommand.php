<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Command\Categories;

use App\Vokabular\Frontend\Shared\Domain\Bus\Command\Command;

class CreateCategoryCommand  implements Command
{
    public function __construct(private string $name)
    {
    }

    public function name(): string
    {
        return $this->name;
    }
}