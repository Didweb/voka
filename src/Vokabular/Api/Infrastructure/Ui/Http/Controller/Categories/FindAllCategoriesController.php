<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Categories;

use App\Vokabular\Api\Application\Query\Categories\FindAllCategoriesQuery;
use App\Vokabular\Api\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;

class FindAllCategoriesController
{

    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(): JsonResponse
    {
        try {

            $result = $this->queryBus->ask(
                new FindAllCategoriesQuery()
            );

            return   new JsonResponse([
                'status' => 'ok',
                'data' => $result->toArray()
            ],200);

        } catch (\Exception $e) {
            return new JsonResponse([
                'status' => 'error',
                'code' => $e->getCode(),
                'errorMessage' => $e->getMessage(),
            ]);
        }

    }
}