<?php

namespace App\Tests\Frontend\Frontoffice\Application\Query\Training;

use App\Tests\Double\Api\Domain\Model\Words\WordStub;
use App\Vokabular\Api\Domain\Model\Words\Word;
use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Training\GetNextWord;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Training\GetNextWordQuery;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\SetUp\Setup;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Training\GoalTraining;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Training\RouteTraining;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Training\RouteTrainingWord;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Training\RouteTrainingWordCollection;
use Monolog\Test\TestCase;

class NewWordTrainingHandlerTest extends TestCase
{

    public function test_Next_Words_List_10_Words()
    {
        $nItems = 10;
        $query = $this->generateGoal($nItems);

        $this->assertEquals($query->route()['currentWord'], 0);

        $handle = new GetNextWord();

        for($t=0; $t<25; $t++) {
            $goalResponse = $handle->__invoke($query);
            $this->assertLessThanOrEqual($nItems-1, $goalResponse->route()['currentWord']);
        }

    }


    public function test_Next_Words_List_5_Words()
    {
        $nItems = 5;
        $query = $this->generateGoal($nItems);

        $this->assertEquals($query->route()['currentWord'], 0);

        $handle = new GetNextWord();

        for($t=0; $t<25; $t++) {
            $goalResponse = $handle->__invoke($query);
            $this->assertLessThanOrEqual($nItems-1, $goalResponse->route()['currentWord']);
        }

    }

    public function generateGoal($nItems): GetNextWordQuery
    {
        $words = [];
        $roueTrainingWord = [];

        for($n=0; $n<=$nItems; $n++) {
            $words[$n] = WordStub::random();
            $roueTrainingWord[$n] = new RouteTrainingWord($n, 0, 0,);
        }

        $wordCollection = new WordsCollection($words);
        $routeWordCollection = new RouteTrainingWordCollection($roueTrainingWord);
        $routeTraining = new RouteTraining(0, 1, $routeWordCollection);

        $setup = new SetUp($nItems, null, null);

        return new GetNextWordQuery(
            $wordCollection->toArray(),
            $setup->toArray(),
            $routeTraining->toArray()
        );
    }


}