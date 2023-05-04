<?php

namespace App\Vokabular\Frontend\Backoffice\Domain\Model\Categories;

class CreateCategory
{

    public function __construct(private string $name)
    {
    }

    public function name(): string
    {
        return $this->name;
    }

}