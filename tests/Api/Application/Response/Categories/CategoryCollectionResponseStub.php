<?php

namespace App\Tests\Api\Application\Response\Categories;

use App\Tests\Double\Api\Domain\Model\Categories\CategoryStub;
use App\Vokabular\Api\Application\Response\Categories\CategoryCollectionResponse;
use App\Vokabular\Api\Application\Response\Categories\CategoryResponse;
use App\Vokabular\Api\Domain\Model\Categories\CategoryCollection;

class CategoryCollectionResponseStub
{
    public static function listCatgories(): CategoryCollectionResponse
    {
        $allCategories =  [
            CategoryStub::list('Hause'),
            CategoryStub::list('Büro'),
            CategoryStub::list('Familie'),
            CategoryStub::list('Transport'),
            CategoryStub::list('Köper')
        ];

        $categoryCollection = CategoryCollection::init();
        foreach ($allCategories as $category) {
            $categoryResponse = new CategoryResponse($category);
            $categoryCollection->add($categoryResponse);
        }

        return new CategoryCollectionResponse($categoryCollection);
    }
}