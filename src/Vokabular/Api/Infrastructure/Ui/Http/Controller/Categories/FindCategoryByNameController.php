<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Categories;

use App\Vokabular\Api\Application\Query\Categories\FindCategoryByNameQuery;
use App\Vokabular\Api\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FindCategoryByNameController
{

    public function __construct(private QueryBus $queryBus)
    {
    }


    public function __invoke(Request $request)
    {
        try {
            $name = $request->get('name', '');
            $result = $this->queryBus->ask(
                new FindCategoryByNameQuery($name)
            );

            $code = (!empty($result))?201:200;
            $notOrYes = (!empty($result->categories()))?'':' NOT';

            $response = new JsonResponse([
                'status' => 'ok',
                'code' => $code,
                'found' => !empty($result->categories()),
                'message' => 'Category with the name: '.$name.$notOrYes.' found',
                'data' => [
                $result
            ]
            ],$code);

        }  catch (\Exception $e) {
            $response = new JsonResponse([
                'status' => 'error',
                'code' => $e->getCode(),
                'errorMessage' => $e->getMessage(),
            ]);
        }
        return $response;
    }
}