<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Words;



use App\Vokabular\Api\Application\Query\Words\GetWordsFromSetupQuery;
use App\Vokabular\Api\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetWordsFromSetupController
{

    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request)
    {
        try {
            $query = new GetWordsFromSetupQuery(
                $request->get('n_words'),
                json_decode($request->get('level')),
                json_decode($request->get('category'))
            );

           $result = $this->queryBus->ask($query);

            return   new JsonResponse([
                'status' => 'ok',
                'data' => $result->toArray()
            ],200);

        } catch (\Exception $e) {
            return  new JsonResponse([
                'status' => 'error',
                'data' => [],
                'code' => $e->getCode(),
                'errorMessage' => $e->getMessage(),
            ]);
        }
    }
}