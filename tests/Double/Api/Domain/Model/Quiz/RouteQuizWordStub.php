<?php

namespace App\Tests\Double\Api\Domain\Model\Quiz;

use App\Vokabular\Frontend\Frontoffice\Domain\Model\Quiz\RouteQuizWord;

class RouteQuizWordStub
{

    public static function create($keyWord, $shown = 0, $hits = 0): RouteQuizWord
    {
        return new RouteQuizWord(
            $keyWord,
            $shown,
            0,
            $hits,
            0
        );
    }


    public static function listCreate($nItems):array
    {
        $list = [];
        for ($n=0; $n<=$nItems; $n++) {
            $shown = ($n==0)?1:0;
            $hits = ($n==0)?1:0;

            $list[$n] = RouteQuizWordStub::create($n, $shown, $hits);
        }

        return $list;
    }
}