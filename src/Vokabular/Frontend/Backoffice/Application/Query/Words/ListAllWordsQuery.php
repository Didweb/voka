<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Query\Words;

use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Query;

class ListAllWordsQuery implements Query
{

    public function __construct(private array $pagination)
    {
    }

    public function pagination(): array
    {
        return $this->pagination;
    }

}