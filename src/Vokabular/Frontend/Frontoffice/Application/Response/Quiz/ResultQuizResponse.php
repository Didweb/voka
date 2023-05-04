<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Response\Quiz;

use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Response;

class ResultQuizResponse implements Response
{

    public function  __construct(
        private bool $result,
        private array $wordCollection,
        private array $score,
        private array $route,
        private array $wordResult,
        private array $setup
    )
    {
    }

    public function result(): bool
    {
        return $this->result;
    }

    public function wordCollection(): array
    {
        return $this->wordCollection;
    }

    public function score(): array
    {
        return $this->score;
    }

    public function route(): array
    {
        return $this->route;
    }

    public function wordResult(): array
    {
        return $this->wordResult;
    }

    public function setup(): array
    {
        return $this->setup;
    }

    public function toArray(): array
    {
        return [
            'result' => $this->result(),
            'wordCollection' => $this->wordCollection(),
            'score' => $this->score(),
            'route' => $this->route(),
            'wordResult' => $this->wordResult(),
            'setup' => $this->setup(),
        ];
    }

}