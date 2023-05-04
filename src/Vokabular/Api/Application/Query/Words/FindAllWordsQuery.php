<?php

namespace App\Vokabular\Api\Application\Query\Words;

use App\Vokabular\Api\Domain\Service\Pagination;
use App\Vokabular\Api\Shared\Domain\Bus\Query\Query;

class FindAllWordsQuery implements Query
{

    public function __construct(private array $pagination)
    {
    }

    public function pagination(): array
    {
        return $this->pagination;
    }

}