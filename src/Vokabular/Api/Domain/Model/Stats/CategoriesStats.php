<?php

namespace App\Vokabular\Api\Domain\Model\Stats;

class CategoriesStats
{

    public function __construct(
        private int $nCategories,
        private array $wordsByCategory
    )
    {
    }

    public function nCategories(): int
    {
        return $this->nCategories;
    }

    public function wordsByCategory(): array
    {
        return $this->wordsByCategory;
    }

    public function toArray(): array
    {
        return [
            'nCategories' => $this->nCategories(),
            'wordsByCategory' => $this->wordsByCategory()
        ];
    }
}