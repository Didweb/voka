<?php

namespace App\Vokabular\Api\Infrastructure\Persistence\Doctrine\Type;

use App\Vokabular\Api\Domain\Model\Categories\ValuesObject\CategoryId;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class CategoryIdType extends StringType
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

        return  CategoryId::create($value);
    }
}