<?php

namespace App\Vokabular\Frontend\Frontoffice\Domain\Model\SetUp;


class Setup
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

    public function queryCurlGet(): string
    {
        $query = '?n_words='.$this->n_words();

        if($this->level() != null) {
            $query.= '&level=["'.implode('","',$this->level()).'"]';
        }

        if ($this->category() != null) {
            $query.= '&category=["'.implode('","',$this->category()).'"]';
        }

        return $query;
    }


}