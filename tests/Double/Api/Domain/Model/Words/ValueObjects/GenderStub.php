<?php

namespace App\Tests\Double\Api\Domain\Model\Words\ValueObjects;

use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Gender;
use App\Vokabular\Shared\Infrastructure\Helper\Faker;

class GenderStub
{
    public static function random(): Gender
    {
        return new Gender(
            Faker::randomElement(Gender::validValues())
        );
    }

    public static function create($gender): Gender
    {
        return new Gender($gender);
    }
}