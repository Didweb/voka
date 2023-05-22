<?php

namespace App\Vokabular\Api\Domain\Model\Users;

use App\Vokabular\Api\Domain\Collection\ObjectCollection;

class UserTrainingCollection  extends ObjectCollection
{

    protected function className(): string
    {
        return UserTraining::class;
    }

    public function toArray(): array
    {
        $convertToArray = [];
        foreach($this->getCollection() as $items) {
            $convertToArray[] = UserTraining::toArray($items);
        }
        return $convertToArray;
    }

    public  function fromArray(array $arrays): void
    {
        foreach ($arrays as $array) {
            $this->add(UserTraining::fromArray($array));
        }
    }
}