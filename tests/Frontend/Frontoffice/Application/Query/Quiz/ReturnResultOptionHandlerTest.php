<?php

namespace App\Tests\Frontend\Frontoffice\Application\Query\Quiz;

use App\Tests\Double\Api\Domain\Model\Quiz\RouteQuizWordStub;
use App\Tests\Double\Api\Domain\Model\Words\WordStub;
use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz\ReturnResultOptionQuiz;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz\ReturnResultOptionQuizQuery;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Quiz\RouteQuiz;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Quiz\RouteQuizWordCollection;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Score\Score;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\SetUp\Setup;
use Monolog\Test\TestCase;

class ReturnResultOptionHandlerTest extends TestCase
{
    private array $words;
    private array $setup;
    private array $score;
    private array $route;

    protected function setUp(): void
    {

        $collection = new WordsCollection(WordStub::listCreate());
        $this->words = $collection->toArray();

        $setupDomain = new Setup(10, null, null);
        $this->setup = $setupDomain->toArray();

        $scoreDomain = new Score(0, 0, 0);
        $this->score = $scoreDomain->toArray();

        $routeWord = RouteQuizWordStub::listCreate(count($this->words));
        $routeCollectionDomain = new RouteQuizWordCollection($routeWord);
        $routeDomain = new RouteQuiz(
            0,
            1,
            false,
            $routeCollectionDomain
        );
        $routeDomain->initWordsCollection(count($this->words));
        $this->route = $routeDomain->toArray();

        parent::setUp();
    }

    public function test_check_option_correct_result()
    {

        $query = new ReturnResultOptionQuizQuery(
            'die',
            10,
            $this->words,
            $this->score,
            $this->route,
            $this->setup
        );

        $this->assertEquals(0, $this->score['hits']);

        $handler = new ReturnResultOptionQuiz();
        $handlerResponse = $handler->__invoke($query);

        $this->assertEquals(1, $handlerResponse->score()['hits']);
        $this->assertEquals(0, $handlerResponse->score()['failure']);
        $this->assertEquals(100, $handlerResponse->score()['hitPercentage']);

        $this->assertTrue($handlerResponse->result());

    }

    public function test_check_option_error_result()
    {

        $query = new ReturnResultOptionQuizQuery(
            'der',
            10,
            $this->words,
            $this->score,
            $this->route,
            $this->setup
        );

        $this->assertEquals(0, $this->score['hits']);

        $handler = new ReturnResultOptionQuiz();
        $handlerResponse = $handler->__invoke($query);

        $this->assertEquals(0, $handlerResponse->score()['hits']);
        $this->assertEquals(1, $handlerResponse->score()['failure']);
        $this->assertEquals(0, $handlerResponse->score()['hitPercentage']);

        $this->assertFalse($handlerResponse->result());

    }
}