<?php

namespace App\Vokabular\Api\Infrastructure\Persistence\Doctrine\Type;

use App\Vokabular\Api\Shared\Domain\ValueObjects\Email;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class EmailType extends StringType
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

        return new Email($value);
    }


}