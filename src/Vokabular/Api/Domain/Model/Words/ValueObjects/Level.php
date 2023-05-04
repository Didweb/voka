<?php

namespace App\Vokabular\Api\Domain\Model\Words\ValueObjects;

use App\Vokabular\Api\Shared\Domain\ValueObjects\Enum;

class Level extends Enum
{
    public const A1 = 'A1';
    public const A2 = 'A2';
    public const B1 = 'B1';
    public const B2 = 'B2';
    public const C1 = 'C1';
    public const C2 = 'C2';


    public static function validValues(): array
    {
        return [
            self::A1,
            self::A2,
            self::B1,
            self::B2,
            self::C1,
            self::C2
        ];
    }
}