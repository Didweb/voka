<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Query\Training;

use App\Vokabular\Frontend\Frontoffice\Application\Response\Training\GetNextWordResponse;
use App\Vokabular\Frontend\Frontoffice\Domain\Service\GoalFactory;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryHandler;

class GetNextWord implements QueryHandler
{

    public function __invoke(GetNextWordQuery $query)
    {
        $goal = GoalFactory::create('TRAINING');

        $goal->nextWordTraining($query);

        return new GetNextWordResponse(
            $goal->wordsCollection()->toArray(),
            $goal->setup()->toArray(),
            $goal->routeTraining()->toArray(),
            $goal->pathToTemplateNextWord()
        );
    }
}