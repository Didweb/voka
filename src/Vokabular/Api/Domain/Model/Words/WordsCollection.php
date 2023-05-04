<?php

namespace App\Vokabular\Api\Domain\Model\Words;

use App\Vokabular\Api\Domain\Collection\ObjectCollection;

class WordsCollection extends ObjectCollection
{

    protected function className(): string
    {
        return Word::class;
    }

    public function toArray(): array
    {
        $convertToArray = [];
        foreach($this->getCollection() as $items) {
            $convertToArray[] = Word::toArray($items);
        }
        return $convertToArray;
    }

    public  function fromArray(array $arrays): void
    {
        foreach ($arrays as $array) {
            $this->add(Word::fromArray($array));
        }
    }


    public function self(): self
    {
        return $this;
    }

}