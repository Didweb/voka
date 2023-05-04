<?php

namespace App\Tests\Frontend\Frontoffice\Application\Query\SetUp;

use App\Tests\Double\Api\Domain\Model\Words\WordStub;
use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Frontend\Frontoffice\Application\Query\SetUp\FindWordsFromSetupQuery;
use App\Vokabular\Frontend\Frontoffice\Application\Response\SetUp\SetUpWordsResponse;
use App\Vokabular\Frontend\Frontoffice\Domain\Service\GoalFactory;
use App\Vokabular\Frontend\Shared\Infrastructure\Service\CurlQueryConnect;
use Monolog\Test\TestCase;

class SetUpHandlerTest extends TestCase
{

    private CurlQueryConnect $curlQueryConnect;

    protected function setUp(): void
    {

        $collection = new WordsCollection(WordStub::listCreate());
        $words = ['status'=>'ok', 'data'=> $collection->toArray()];

        $this->curlQueryConnect = $this->createMock(CurlQueryConnect::class);
        $this->curlQueryConnect->expects($this->any())
            ->method('curl')
            ->willReturn($words);

        parent::setUp();
    }


    public function test_Setup_Training()
    {
        $query = new FindWordsFromSetupQuery(
            5,
            null,
            null,
            'TRAINING'
        );
        $goal = GoalFactory::create('TRAINING');
        $goal->initSetUpFromArray($query->toArray());
        $parameters = $goal->setup()->queryCurlGet();
        $words = $this->curlQueryConnect->curl('MOCKED');


        $goal->initGoalSetUp($words['data']);
        $wordsCollection = $goal->wordsCollection()->getCollection();

        $setUpWordResponse = new SetUpWordsResponse(
            $goal->wordsCollection()->toArray(),
            $goal->setUp()->toArray(),
            $goal->route()->toArray(),
            null,
            $goal->pathToTemplate()
        );

        $this->assertEquals('Schreibtisch', $wordsCollection[0]->word());
        $this->assertEquals('Hause', $wordsCollection[0]->category()->name());
        $this->assertEquals('Drucker', $wordsCollection[2]->word());
        $this->assertEquals('Hause', $wordsCollection[2]->category()->name());
        $this->assertEquals('der', $wordsCollection[0]->gender()->__toString());
        $this->assertEquals('Tisch', $wordsCollection[5]->word());
        $this->assertEquals('der', $wordsCollection[5]->gender()->__toString());
        $this->assertEquals('Büro', $wordsCollection[5]->category()->name());
        $this->assertEquals('?n_words=5', $parameters);

        $this->assertEquals('Schreibtisch', $setUpWordResponse->wordCollection()[0]['word']);
        $this->assertEquals('Hause', $setUpWordResponse->wordCollection()[0]['category']['name']);
        $this->assertEquals('Drucker', $setUpWordResponse->wordCollection()[2]['word']);
        $this->assertEquals('Hause', $setUpWordResponse->wordCollection()[2]['category']['name']);
        $this->assertEquals('der', $setUpWordResponse->wordCollection()[0]['gender']);
        $this->assertEquals('Tisch', $setUpWordResponse->wordCollection()[5]['word']);
        $this->assertEquals('der', $setUpWordResponse->wordCollection()[5]['gender']);
        $this->assertEquals('Büro', $setUpWordResponse->wordCollection()[5]['category']['name']);

    }
}