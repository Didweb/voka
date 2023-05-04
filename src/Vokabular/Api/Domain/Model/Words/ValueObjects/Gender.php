<?php

namespace App\Vokabular\Api\Domain\Model\Words\ValueObjects;

use App\Vokabular\Api\Shared\Domain\ValueObjects\Enum;

class Gender extends Enum
{
    public const DER = 'der';
    public const DIE = 'die';
    public const DAS = 'das';

    public static function validValues(): array
    {
        return [
            self::DER,
            self::DIE,
            self::DAS
        ];
    }
}