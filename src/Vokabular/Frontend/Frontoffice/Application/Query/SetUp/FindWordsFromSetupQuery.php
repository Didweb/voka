<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Query\SetUp;

use App\Vokabular\Frontend\Shared\Domain\Bus\Query\Query;

class FindWordsFromSetupQuery implements Query
{

    public function __construct(
        private int $n_words,
        private ?array $level,
        private ?array $category,
        private string $destination
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

    public function destination(): string
    {
        return $this->destination;
    }

    public function toArray(): array
    {
        return [
            'n_words'   => $this->n_words(),
            'level'     => (empty($this->level()))?null:$this->level(),
            'category'  => (empty($this->category()))?null:$this->category(),
            'destination'  => $this->destination()
        ];
    }

}