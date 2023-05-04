<?php

namespace App\Vokabular\Frontend\Frontoffice\Infrastructure\Ui\Http\Controller\Training;

use App\Vokabular\Frontend\Frontoffice\Application\Query\Training\StartTrainingFromQuizQuery;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class StartTrainingFromQuizController extends AbstractController
{

    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request)
    {
        try {

            $goal = $request->get('goalJson');

            $query = new StartTrainingFromQuizQuery(
                json_decode($goal['wordCollectionJson'], true),
                json_decode($goal['setUpJson'], true)
            );

            $goalResponse = $this->queryBus->ask($query);

            return $this->render($goalResponse->pathToTemplateStartFromQuiz(),[
                'goal' => $goalResponse->toArray()
            ]);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}