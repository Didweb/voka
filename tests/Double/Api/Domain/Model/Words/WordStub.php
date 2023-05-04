<?php

namespace App\Tests\Double\Api\Domain\Model\Words;

use App\Tests\Double\Api\Domain\Model\Categories\CategoryStub;
use App\Tests\Double\Api\Domain\Model\Words\ValueObjects\GenderStub;
use App\Tests\Double\Api\Domain\Model\Words\ValueObjects\LevelStub;
use App\Tests\Double\Api\Domain\Model\Words\ValueObjects\WordIdStub;
use App\Vokabular\Api\Domain\Model\Words\Word;
use App\Vokabular\Shared\Infrastructure\Helper\Faker;

class WordStub
{
    public static function random(): Word
    {
        return new Word(
            WordIdStub::random(),
            Faker::word(),
            Faker::image(),
            GenderStub::random(),
            LevelStub::random(),
            Faker::datetime(),
            Faker::datetime(),
            CategoryStub::randomNew()
        );
    }

    public static function create($gender, $name, $level, $category): Word
    {
        return new Word(
            WordIdStub::random(),
            $name,
            Faker::image(),
            GenderStub::create($gender),
            LevelStub::create($level),
            Faker::datetime(),
            Faker::datetime(),
            $category
        );
    }


    public static function listCreate(): array
    {
        return [
            WordStub::create('der', 'Schreibtisch', 'A1', CategoryStub::list('Hause')),
            WordStub::create('der', 'Müll', 'A1', CategoryStub::list('Hause')),
            WordStub::create('der', 'Drucker', 'A1', CategoryStub::list('Hause')),
            WordStub::create('der', 'Koffer', 'A1', CategoryStub::list('Hause')),
            WordStub::create('der', 'Eimer', 'A1', CategoryStub::list('Büro')),
            WordStub::create('der', 'Tisch', 'A1', CategoryStub::list('Büro')),
            WordStub::create('die', 'Couch', 'A1', CategoryStub::randomNew()),
            WordStub::create('die', 'Rechnung', 'A2', CategoryStub::randomNew()),
            WordStub::create('die', 'Ecker', 'A1', CategoryStub::randomNew()),
            WordStub::create('die', 'Tür', 'A1', CategoryStub::randomNew()),
            WordStub::create('die', 'Pflanze', 'A1', CategoryStub::randomNew()),
            WordStub::create('die', 'Katze', 'A1', CategoryStub::randomNew()),
            WordStub::create('das', 'Papier', 'A1', CategoryStub::randomNew()),
            WordStub::create('das', 'Kissen', 'A1', CategoryStub::randomNew()),
            WordStub::create('das', 'Fernsehgerät', 'A2', CategoryStub::randomNew()),
            WordStub::create('das', 'Bad', 'A1', CategoryStub::randomNew()),
            WordStub::create('das', 'Bild', 'A1', CategoryStub::randomNew()),
            WordStub::create('das', 'Bett', 'A1', CategoryStub::randomNew()),
        ];
    }

}