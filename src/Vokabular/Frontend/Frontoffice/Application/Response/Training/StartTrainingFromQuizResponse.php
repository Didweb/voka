<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Response\Training;

use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Response;

class StartTrainingFromQuizResponse implements Response
{

    public function __construct(
        private array $wordCollection,
        private array $setup,
        private array $route,
        private string $pathToTemplateStartFromQuiz,
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

    public function pathToTemplateStartFromQuiz(): string
    {
        return $this->pathToTemplateStartFromQuiz;
    }


    public function toArray(): array
    {
        return [
            'wordCollection' => $this->wordCollection(),
            'setup' => $this->setup(),
            'route' => $this->route(),
            'pathToTemplateStartFromQuiz' => $this->pathToTemplateStartFromQuiz()
        ];
    }
}