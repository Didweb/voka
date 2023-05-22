<?php

namespace App\Vokabular\Api\Domain\Model\Stats;

class WordStats
{
    private int $nWordsTotal;

    public function __construct(
        private int $nWordsDer,
        private int $nWordsDie,
        private int $nWordsDas
    )
    {
        $this->nWordsTotal = $nWordsDer + $nWordsDie + $nWordsDas;
    }

    public function nWordsTotal(): int
    {
        return $this->nWordsTotal;
    }

    public function nWordsDer(): int
    {
        return $this->nWordsDer;
    }

    public function nWordsDie(): int
    {
        return $this->nWordsDie;
    }

    public function nWordsDas(): int
    {
        return $this->nWordsDas;
    }

    public function toArray(): array
    {
        return [
            'nWordsTotal' => $this->nWordsTotal(),
            'nWordsDer' => $this->nWordsDer(),
            'nWordsDie' => $this->nWordsDie(),
            'nWordsDas' => $this->nWordsDas()
        ];
    }
}