<?php

namespace App\Tests\Double\Api\Domain\Model\Words\ValueObjects;

use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Level;
use App\Vokabular\Shared\Infrastructure\Helper\Faker;

class LevelStub
{
    public static function random(): Level
    {
        return new Level(
            Faker::randomElement(Level::validValues())
        );
    }

    public static function create($level): Level
    {
        return new Level($level);
    }

}