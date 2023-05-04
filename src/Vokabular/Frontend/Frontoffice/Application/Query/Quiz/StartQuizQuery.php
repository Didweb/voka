<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz;

use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Query;

class StartQuizQuery implements Query
{

    public function __construct(
        private array $wordCollection,
        private array $setup
    )
    {
    }

    public function wordCollection(): array
    {
        return $this->wordCollection;
    }

    public function setup(): array
    {
        return $this->setup;
    }

}