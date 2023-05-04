<?php

namespace App\Vokabular\Api\Infrastructure\Persistence\Doctrine\Type;

use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Level;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class LevelType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!$value) {
            return null;
        }
        return (string) $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (!$value) {
            return null;
        }

        return  new Level($value);
    }
}