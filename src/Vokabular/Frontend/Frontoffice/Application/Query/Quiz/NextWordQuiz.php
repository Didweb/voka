<?php

namespace App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz;

use App\Vokabular\Frontend\Frontoffice\Application\Response\Quiz\NextWordQuizResponse;
use App\Vokabular\Frontend\Frontoffice\Domain\Service\GoalFactory;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryHandler;

class NextWordQuiz implements QueryHandler
{

    public function __invoke(NextWordQuizQuery $query)
    {
        $goal = GoalFactory::create('QUIZ');

        $goal->nextWord($query);

        return new NextWordQuizResponse(
            $goal->wordsCollection()->toArray(),
            $goal->setup()->toArray(),
            $goal->routeQuiz()->toArray(),
            $goal->score()->toArray(),
            $goal->pathToTemplateNextWord()
        );
    }
}