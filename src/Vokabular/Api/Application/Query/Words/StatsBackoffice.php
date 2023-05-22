<?php

namespace App\Vokabular\Api\Application\Query\Words;

use App\Vokabular\Api\Application\Response\Words\StatsBackofficeResponse;
use App\Vokabular\Api\Domain\Model\Stats\WordStats;
use App\Vokabular\Api\Domain\Model\Words\WordRepository;
use App\Vokabular\Api\Shared\Domain\Bus\Query\QueryHandler;

class StatsBackoffice implements QueryHandler
{

    public function __construct(private WordRepository $repository)
    {
    }

    public function __invoke(StatsBackofficeQuery $query): StatsBackofficeResponse
    {
        $response = $this->repository->findStatsBackoffice();

        $wordsStats = new WordStats(
            $response['total_der'],
            $response['total_die'],
            $response['total_das'],
        );
        return new StatsBackofficeResponse($wordsStats->toArray(),[]);
    }
}