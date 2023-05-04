<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Words;

use App\Vokabular\Api\Application\Query\Words\FindAllWordsQuery;
use App\Vokabular\Api\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FindAllWordsController
{

    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $page = $request->get('page', 1);
            $pagination = [
                'page' => $page
                ];
            $result = $this->queryBus->ask(new FindAllWordsQuery($pagination));

            return   new JsonResponse([
                'status' => 'ok',
                'pagination' => ($result->pagination())?$result->pagination()->toArray():null,
                'data' => $result->toArray()
            ],200);

        } catch (\Exception $e) {
            return  new JsonResponse([
                'status' => 'error',
                'code' => $e->getCode(),
                'errorMessage' => $e->getMessage(),
            ]);
        }
    }
}