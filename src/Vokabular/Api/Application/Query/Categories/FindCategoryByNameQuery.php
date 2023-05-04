<?php

namespace App\Vokabular\Api\Application\Query\Categories;

use App\Vokabular\Api\Shared\Domain\Bus\Query\Query;

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