<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Query\Categories;

use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Query;

class FindCategoryByNameQuery implements Query
{
    public function __construct(private string $name)
    {
    }

    public function name(): string
    {
        return $this->name;
    }
}