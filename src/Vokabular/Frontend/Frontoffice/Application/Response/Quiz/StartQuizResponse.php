<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Response\Quiz;

use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Response;

class StartQuizResponse implements Response
{

    public function __construct(
        private array $wordCollection,
        private array $setup,
        private array $score,
        private array $route,
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

    public function toArray(): array
    {
        return [
            'wordCollection' => $this->wordCollection(),
            'setup' => $this->setup(),
            'score' => $this->score(),
            'route' => $this->route()
        ];
    }
}