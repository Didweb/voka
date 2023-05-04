<?php

namespace App\Vokabular\Frontend\Frontoffice\Domain\Model\Quiz;

use App\Vokabular\Api\Domain\Collection\ObjectCollection;

class RouteQuizWordCollection extends ObjectCollection
{

    protected function className(): string
    {
        return RouteQuizWord::class;
    }

    public function toArray(): array
    {
        $convertToArray = [];
        foreach($this->getCollection() as $items) {
            $convertToArray[] = RouteQuizWord::toArray($items);
        }
        return $convertToArray;
    }

    public  function fromArray($arrays): self
    {
        $convertFromArray = [];
        foreach($arrays as $items) {
            $convertFromArray[] = RouteQuizWord::fromArray($items);
        }
        $this->objects = $convertFromArray;
        return $this;
    }
}