<?php

namespace App\Vokabular\Api\Application\Query\Words;

use App\Vokabular\Api\Shared\Domain\Bus\Query\Query;

class GetWordsFromSetupQuery implements Query
{

    public function __construct(
        private int $n_words,
        private ?array $level,
        private ?array $category
    )
    {
    }

    public function n_words(): int
    {
        return $this->n_words;
    }

    public function level(): ?array
    {
        return $this->level;
    }

    public function category(): ?array
    {
        return $this->category;
    }

    public function toArray(): array
    {
        return [
            'n_words' => $this->n_words(),
            'level' => $this->level(),
            'category' => $this->category()
        ];
    }

}