<?php

namespace App\Vokabular\Shared\Infrastructure\Helper;

use Faker\Factory;

final class Faker
{
    private const LANG = 'de_DE';

    public static function word(): string
    {
        return Factory::create(self::LANG)->word();
    }

    public static function datetime(): \DateTime
    {
        return Factory::create(self::LANG)->dateTime();
    }

    public static function uuid(): string
    {
        return Factory::create(self::LANG)->uuid;
    }

    public static function image(): string
    {
        return Factory::create(self::LANG)->slug(2, false).'.jpg';
    }

    public static function randomElement(array $values): string
    {
        return Factory::create(self::LANG)->randomElement($values);
    }



}