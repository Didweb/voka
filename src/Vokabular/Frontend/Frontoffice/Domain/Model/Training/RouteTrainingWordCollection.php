<?php

namespace App\Vokabular\Frontend\Frontoffice\Domain\Model\Training;

use App\Vokabular\Api\Domain\Collection\ObjectCollection;

class RouteTrainingWordCollection extends ObjectCollection
{

    protected function className(): string
    {
        return RouteTrainingWord::class;
    }

    public function toArray(): array
    {
        $convertToArray = [];
        foreach($this->getCollection() as $items) {
            $convertToArray[] = RouteTrainingWord::toArray($items);
        }
        return $convertToArray;
    }

    public  function fromArray($arrays): self
    {
        $convertFromArray = [];
        foreach($arrays as $items) {
            $convertFromArray[] = RouteTrainingWord::fromArray($items);
        }
        $this->objects = $convertFromArray;
        return $this;
    }

    public function self(): self
    {
        return $this;
    }

}