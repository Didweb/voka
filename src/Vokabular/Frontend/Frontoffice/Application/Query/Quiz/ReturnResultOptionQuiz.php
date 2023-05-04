<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz;

use App\Vokabular\Frontend\Frontoffice\Application\Response\Quiz\ResultQuizResponse;
use App\Vokabular\Frontend\Frontoffice\Domain\Service\GoalFactory;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryHandler;

class ReturnResultOptionQuiz implements QueryHandler
{
    public function __invoke(ReturnResultOptionQuizQuery $query)
    {
        $goal = GoalFactory::create('QUIZ');

        $goal->checkAndUpdateOptionQuiz($query);

        return new ResultQuizResponse(
            $goal->currentResultOption(),
            $goal->wordsCollection()->toArray(),
            $goal->score()->toArray(),
            $goal->routeQuiz()->toArray(),
            $goal->getWordResult(),
            $goal->setup()->toArray()
        );
    }
}