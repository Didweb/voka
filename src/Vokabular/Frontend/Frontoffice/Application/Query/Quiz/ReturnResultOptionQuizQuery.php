<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz;

use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Query;

class ReturnResultOptionQuizQuery implements Query
{

    public function __construct(
        private string $option,
        private int $wordPosition,
        private array $wordsCollection,
        private array $score,
        private array $route,
        private array $setup
    )
    {
    }

    public function option(): string
    {
        return $this->option;
    }

    public function wordPosition(): int
    {
        return $this->wordPosition;
    }

    public function wordsCollection(): array
    {
        return $this->wordsCollection;
    }

    public function score(): array
    {
        return $this->score;
    }

    public function route(): array
    {
        return $this->route;
    }

    public function setup(): array
    {
        return $this->setup;
    }

}