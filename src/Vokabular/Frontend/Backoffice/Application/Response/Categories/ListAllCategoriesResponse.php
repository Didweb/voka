<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Response\Categories;


use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Response;

class ListAllCategoriesResponse implements Response
{

    public function __construct(private array $allCategories)
    {
    }

    public function allCategories(): array
    {
        return $this->allCategories;
    }


}