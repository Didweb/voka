<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Query\Training;

use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Query;

class GetNextWordQuery implements Query
{

    public function __construct(
        private array $wordCollection,
        private array $setup,
        private array $route
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

}