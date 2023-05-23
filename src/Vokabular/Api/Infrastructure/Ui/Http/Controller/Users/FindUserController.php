<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Users;

use App\Vokabular\Api\Application\Query\Users\GetUserQuery;
use App\Vokabular\Api\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FindUserController
{

    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $email = $request->get('email');
            $result = $this->queryBus->ask(new GetUserQuery($email));
            return   new JsonResponse([
                'status' => 'ok',
                'pagination' => '',
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