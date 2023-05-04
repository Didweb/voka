<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Query\Training;

use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Query;

class StartTrainingFromQuizQuery implements Query
{

    public function __construct(
        private array $wordCollection,
        private array $setup,
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