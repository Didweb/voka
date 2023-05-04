<?php

namespace App\Vokabular\Frontend\Frontoffice\Infrastructure\Ui\Http\Controller\Quiz;

use App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz\NextWordQuizQuery;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class NextWordQuizController extends AbstractController
{

    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request)
    {
        try {
            $goal = $request->get('goal');

            $query = new NextWordQuizQuery(
                json_decode($goal['wordCollectionJson'], true),
                json_decode($goal['setUpJson'], true),
                json_decode($goal['routingJson'], true),
                json_decode($goal['scoreJson'], true)
            );

            $goalResponse = $this->queryBus->ask($query);

            return $this->render($goalResponse->pathToTemplateNextWord(), [
                'goal' => $goalResponse->toArray()
            ]);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}