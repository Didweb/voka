<?php

namespace App\Tests\Double\Api\Domain\Model\Categories\ValueObjects;

use App\Vokabular\Api\Domain\Model\Categories\ValuesObject\CategoryId;
use App\Vokabular\Shared\Infrastructure\Helper\Faker;

class CategoryIdStub
{
    public static function random(): CategoryId
    {
        return CategoryId::create(Faker::uuid());
    }
}