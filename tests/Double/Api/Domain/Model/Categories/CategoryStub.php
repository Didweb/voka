<?php

namespace App\Tests\Double\Api\Domain\Model\Categories;


use App\Tests\Double\Api\Domain\Model\Categories\ValueObjects\CategoryIdStub;
use App\Vokabular\Api\Domain\Model\Categories\Category;
use App\Vokabular\Shared\Infrastructure\Helper\Faker;

class CategoryStub
{
    public static function randomNew(): Category
    {
        return new Category(
            CategoryIdStub::random(),
            Faker::word(),
            Faker::datetime(),
            Faker::datetime(),
            null
        );
    }

    public static function list(string $name): Category
    {
        return new Category(
            CategoryIdStub::random(),
            $name,
            Faker::datetime(),
            Faker::datetime(),
            null
        );
    }
}