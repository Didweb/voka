<?php

namespace App\Tests\Frontend\Frontoffice\Application\Query\Quiz;

use App\Tests\Double\Api\Domain\Model\Words\WordStub;
use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz\StartQuiz;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz\StartQuizQuery;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\SetUp\Setup;
use Monolog\Test\TestCase;

class StartQuizHandlerTest extends TestCase
{

    private array $words;
    private array $setup;

    protected function setUp(): void
    {

        $collection = new WordsCollection(WordStub::listCreate());
        $this->words = $collection->toArray();

        $setupDomain = new Setup(10, null, null);
        $this->setup = $setupDomain->toArray();

        parent::setUp();
    }

    public function test_start_quiz_correct_data()
    {
        $startQuizQuery = new StartQuizQuery(
            $this->words,
            $this->setup,
        );

        $handler = new StartQuiz();
        $handlerResponse = $handler->__invoke($startQuizQuery);

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