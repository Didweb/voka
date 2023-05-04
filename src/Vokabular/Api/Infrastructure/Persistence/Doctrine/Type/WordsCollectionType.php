<?php

namespace App\Vokabular\Api\Infrastructure\Persistence\Doctrine\Type;

use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use Doctrine\DBAL\Types\JsonType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class WordsCollectionType extends JsonType
{
    /*** @param WordsCollection $otherContacts */
    public function convertToDatabaseValue($otherContacts, AbstractPlatform $platform)
    {
        if (!$otherContacts) {
            return null;
        }

        return $otherContacts->encode();
    }

    public function convertToPHPValue($otherContacts, AbstractPlatform $platform)
    {
        if (!$otherContacts) {
            return null;
        }

        $decode = WordsCollection::decode($otherContacts);

        return WordsCollection::create($decode);
    }
}