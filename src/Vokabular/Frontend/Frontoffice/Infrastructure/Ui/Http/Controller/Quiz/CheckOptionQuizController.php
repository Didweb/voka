<?php

namespace App\Vokabular\Frontend\Frontoffice\Infrastructure\Ui\Http\Controller\Quiz;

use App\Vokabular\Api\Domain\Model\Words\Word;
use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz\ReturnResultOptionQuiz;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz\ReturnResultOptionQuizQuery;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CheckOptionQuizController extends AbstractController
{

    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request)
    {
        $goal = $request->get('goalJson');

        $query = new ReturnResultOptionQuizQuery(
                    $request->get('option'),
                    (int)$request->get('wordPosition'),
                    json_decode($goal['wordCollectionJson'], true),
                    json_decode($goal['scoreJson'], true),
                    json_decode($goal['routingJson'], true),
                    json_decode($goal['setUpJson'], true)
                );

        $resultQuiz = $this->queryBus->ask($query);

        if($resultQuiz->result() == true) {

            return $this->render('@frontend_front/quiz/imageWordQuiz.html.twig', [
                'goal' => $resultQuiz->toArray(),
                'option' => $request->get('option')
            ]);
        } else {

            return $this->render('@frontend_front/quiz/imageWordQuizError.html.twig',[
                'goal' => $resultQuiz->toArray(),
                'option' => $request->get('option')
            ]);
        }

    }
}