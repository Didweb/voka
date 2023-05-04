<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Response\Words;

use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Response;

class ListAllWordsResponse implements Response
{

    public function __construct(
        private array $allWords,
        private array $pagination,
    )
    {
    }

    public function allWords(): array
    {
        return $this->allWords;
    }

    public function pagination(): array
    {
        return $this->pagination;
    }

}