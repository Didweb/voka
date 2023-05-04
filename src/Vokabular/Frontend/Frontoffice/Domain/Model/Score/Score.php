<?php

namespace App\Vokabular\Frontend\Frontoffice\Domain\Model\Score;

class Score
{

    public function __construct(
        private int $hits = 0,
        private int $failure = 0,
        private int $hitPercentage = 0
    )
    {
    }

    public function hits(): int
    {
        return $this->hits;
    }

    public function failure(): int
    {
        return $this->failure;
    }

    public function hitPercentage(): int
    {
        return $this->hitPercentage;
    }

    public function toArray(): array
    {
        return [
            'hits' => $this->hits(),
            'failure' => $this->failure(),
            'hitPercentage' => $this->hitPercentage()
        ];
    }

    public function updateScore(bool $hit): void
    {

        if($hit) {
            $this->hits = $this->hits() + 1;
        }

        if(!$hit) {
            $this->failure = $this->failure() + 1;
        }

        $total = $this->hits() + $this->failure();

        $this->hitPercentage = ($this->hits() * 100) / $total;

    }
}