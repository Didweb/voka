<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Query\SetUp;

use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Api\Shared\Domain\Bus\Query\Response;
use App\Vokabular\Frontend\Frontoffice\Application\Response\SetUp\SetUpWordsResponse;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\SetUp\Setup;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Training\RouteTraining;
use App\Vokabular\Frontend\Frontoffice\Domain\Service\GoalFactory;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryHandler;
use App\Vokabular\Frontend\Shared\Infrastructure\Service\CurlQueryConnect;

class FindWordsFromSetup implements QueryHandler
{

    public function __construct(private CurlQueryConnect $curlQueryConnect)
    {
    }

    public function __invoke(FindWordsFromSetupQuery $query): SetUpWordsResponse
    {
        try {

            $goal = GoalFactory::create($query->destination());

            $goal->initSetUpFromArray($query->toArray());

            $parameters = $goal->setup()->queryCurlGet();
            $words = $this->curlQueryConnect->curl('/words-from-setup'.$parameters);

            $goal->initGoalSetUp($words['data']);

            return new SetUpWordsResponse(
                $goal->wordsCollection()->toArray(),
                $goal->setUp()->toArray(),
                $goal->route()->toArray(),
                ($query->destination() === 'QUIZ')?$goal->score()->toArray():null,
                $goal->pathToTemplate()
            );

        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }
}