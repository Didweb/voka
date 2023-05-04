<?php

namespace App\Vokabular\Frontend\Frontoffice\Infrastructure\Ui\Http\Controller\Training;

use App\Vokabular\Frontend\Frontoffice\Application\Query\Training\GetNextWordQuery;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class NextWordController extends AbstractController
{

    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request)
    {
        try {

            $goal = $request->get('goal');

            $query = new GetNextWordQuery(
                json_decode($goal['wordCollectionJson'], true),
                json_decode($goal['setUpJson'], true),
                json_decode($goal['routingJson'], true)
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