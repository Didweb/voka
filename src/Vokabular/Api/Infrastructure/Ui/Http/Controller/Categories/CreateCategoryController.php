<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Categories;

use App\Vokabular\Api\Application\Command\Categories\CreateCategoryCommand;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateCategoryController
{

    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
          try {
              $name = $request->get('name', '');
              $this->commandBus->dispatch(
                  new CreateCategoryCommand($name)
              );

              return  new JsonResponse([
                  'status' => 'ok',
                  'code' => 200,
                  'message' => 'The category has been created with the name: '.$name,
                  'data' => []
              ],200);

          }  catch(\Exception $e) {
              return  new JsonResponse([
                  'status' => 'error',
                  'code' => $e->getCode(),
                  'errorMessage' => $e->getMessage(),
              ]);
          }


    }
}