<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Command\Categories;

use App\Vokabular\Frontend\Shared\Domain\Bus\Command\Command;

class DeleteCategoryCommand  implements Command
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}