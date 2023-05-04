<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Query\Training;

use App\Vokabular\Frontend\Frontoffice\Application\Response\Training\StartTrainingFromQuizResponse;
use App\Vokabular\Frontend\Frontoffice\Domain\Service\GoalFactory;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryHandler;

class StartTrainingFromQuiz implements QueryHandler
{
    public function __invoke(StartTrainingFromQuizQuery $query)
    {
        $goal = GoalFactory::create('TRAINING');

        $goal->initTrainingFormQuiz($query);

        return new StartTrainingFromQuizResponse(
            $goal->wordsCollection()->toArray(),
            $goal->setup()->toArray(),
            $goal->routeTraining()->toArray(),
            $goal->pathToTemplateStartFromQuiz()
        );
    }
}