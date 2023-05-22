<?php

namespace App\Vokabular\Api\Application\Response\Words;

use App\Vokabular\Api\Shared\Domain\Bus\Query\Response;

class StatsBackofficeResponse implements Response
{

    public function __construct(
        private array $wordsStats,
        private array $categoriesStats
    )
    {
    }

    public function wordsStats(): array
    {
        return $this->wordsStats;
    }

    public function categoriesStats(): array
    {
        return $this->categoriesStats;
    }

    public function toArray(): array
    {
        return [
            'wordsStats' => $this->wordsStats(),
            'categoriesStats' => $this->categoriesStats()
        ];
    }

}