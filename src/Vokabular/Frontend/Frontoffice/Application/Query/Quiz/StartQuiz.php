<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz;

use App\Vokabular\Frontend\Frontoffice\Application\Response\Quiz\StartQuizResponse;
use App\Vokabular\Frontend\Frontoffice\Domain\Service\GoalFactory;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryHandler;

class StartQuiz implements QueryHandler
{
    public function __invoke(StartQuizQuery $query)
    {
        $goal = GoalFactory::create('QUIZ');
        $goal->initGoalStartQuiz($query);

        return new StartQuizResponse(
            $goal->wordsCollection()->toArray(),
            $goal->setup()->toArray(),
            $goal->score()->toArray(),
            $goal->routeQuiz()->toArray()
        );
    }
}