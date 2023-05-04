<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Categories;

use App\Vokabular\Api\Application\Command\Categories\DeleteCategoryCommand;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DeleteCategoryController
{

    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->commandBus->dispatch(
            new DeleteCategoryCommand($request->get('id'))
        );

        try {
            return  new JsonResponse([
                'status' => 'ok',
                'code' => 200,
                'message' => 'Category has been successfully removed.',
                'data' => []
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