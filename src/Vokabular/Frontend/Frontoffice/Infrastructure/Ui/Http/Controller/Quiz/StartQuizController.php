<?php

namespace App\Vokabular\Frontend\Frontoffice\Infrastructure\Ui\Http\Controller\Quiz;

use App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz\StartQuizQuery;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class StartQuizController extends AbstractController
{


    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request)
    {

        $goal = $request->get('goalJson');
        $query =  new StartQuizQuery(
            json_decode($goal['wordCollectionJson'], true),
            json_decode($goal['setUpJson'], true)
        );
        $goalResponse = $this->queryBus->ask($query);

        return $this->render('@frontend_front/quiz/displayQuiz.html.twig', [
            'goal' => $goalResponse->toArray()
        ]);
    }
}