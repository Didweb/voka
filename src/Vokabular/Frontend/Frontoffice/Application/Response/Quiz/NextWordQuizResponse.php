<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Response\Quiz;


use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Response;

class NextWordQuizResponse implements Response
{

    public function __construct(
        private array $wordCollection,
        private array $setup,
        private array $route,
        private array $score,
        private string $pathToTemplateNextWord
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

    public function pathToTemplateNextWord(): string
    {
        return $this->pathToTemplateNextWord;
    }

    public function toArray(): array
    {
        return [
            'wordCollection' => $this->wordCollection(),
            'setup' => $this->setup(),
            'route' => $this->route(),
            'score' => $this->score(),
            'pathToTemplate' => $this->pathToTemplateNextWord()
        ];
    }

}