<?php

namespace App\Vokabular\Api\Application\Response\Categories;

use App\Vokabular\Api\Domain\Model\Categories\CategoryCollection;
use App\Vokabular\Api\Shared\Domain\Bus\Query\Response;

class CategoryCollectionResponse implements Response
{
    private array $categories;

    public function __construct(CategoryCollection $categoryCollection)
    {
        $this->categories = [];
        foreach($categoryCollection->getCollection() as $category) {
            $this->categories[] = $category;
        }
    }

    public function categories(): array
    {
        return $this->categories;
    }

    public function toArray()
    {
        return array_map(function ($category){
            return $category->toArray();
        }, $this->categories());
    }
}