<?php

namespace App\Tests\Frontend\Frontoffice\Application\Query\Quiz;

use App\Tests\Double\Api\Domain\Model\Quiz\RouteQuizWordStub;
use App\Tests\Double\Api\Domain\Model\Words\WordStub;
use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz\NextWordQuiz;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz\NextWordQuizQuery;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Quiz\RouteQuiz;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Quiz\RouteQuizWordCollection;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Score\Score;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\SetUp\Setup;
use Monolog\Test\TestCase;

class NewWordQuizHandlerTest extends TestCase
{
    private array $score;
    private array $setup;
    private array $words;
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

    public function test_new_word_correct_result()
    {
        $query = new NextWordQuizQuery(
            $this->words,
            $this->setup,
            $this->route,
            $this->score
        );

        $handler = new NextWordQuiz();
        $handlerResponse = $handler->__invoke($query);

        $this->assertEquals('Schreibtisch', $handlerResponse->wordCollection()[0]['word']);
        $this->assertEquals('Hause', $handlerResponse->wordCollection()[0]['category']['name']);
        $this->assertEquals('Drucker', $handlerResponse->wordCollection()[2]['word']);
        $this->assertEquals('Hause', $handlerResponse->wordCollection()[2]['category']['name']);
        $this->assertEquals('der', $handlerResponse->wordCollection()[0]['gender']);
        $this->assertEquals('Tisch', $handlerResponse->wordCollection()[5]['word']);
        $this->assertEquals('der', $handlerResponse->wordCollection()[5]['gender']);
        $this->assertEquals('Büro', $handlerResponse->wordCollection()[5]['category']['name']);
    }
}