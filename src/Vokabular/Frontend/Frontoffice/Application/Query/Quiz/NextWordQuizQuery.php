<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz;

use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Query;

class NextWordQuizQuery implements Query
{

    public function __construct(
        private array $wordCollection,
        private array $setup,
        private array $route,
        private array $score
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

    public function route(): array
    {
        return $this->route;
    }

    public function score(): array
    {
        return $this->score;
    }

}