<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Response\Categories;

use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Response;

class FindCategoryByNameResponse implements Response
{
    private bool $found;

    public function __construct(bool $found)
    {
        $this->found = $found;
    }

    public function found(): bool
    {
        return $this->found;
    }

}