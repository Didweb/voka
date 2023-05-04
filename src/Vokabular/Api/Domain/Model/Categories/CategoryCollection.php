<?php

namespace App\Vokabular\Api\Domain\Model\Categories;


use App\Vokabular\Api\Domain\Collection\ObjectCollection;

class CategoryCollection extends ObjectCollection
{
    private array $arrayItems;

    protected function className(): string
    {
        return Category::class;
    }

    public function toArrayItems(): array
    {
        $this->arrayItems = [];
        foreach ($this->getCollection() as $item) {
            $this->arrayItems[] = $item->toArray();
        }
        return $this->arrayItems;
    }

    public function toObjectItems($array): self
    {
        $this->objects = [];
        foreach ($array as $item) {
            $this->objects[] = Category::fromArray($item);
        }
        return $this;
    }

    public function arrayItems(): array
    {
        return $this->arrayItems;
    }

}