<?php

namespace App\Tests\Double\Api\Domain\Model\Words\ValueObjects;

use App\Vokabular\Api\Domain\Model\Words\ValueObjects\WordId;
use App\Vokabular\Shared\Infrastructure\Helper\Faker;

class WordIdStub
{
    public static function random(): WordId
    {
        return WordId::create(Faker::uuid());
    }
}