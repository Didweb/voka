<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Categories;

use App\Vokabular\Api\Application\Command\Categories\EditCategoryCommand;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditCategoryController
{

    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {

        try {
            $editCategoryCommand =  new EditCategoryCommand(
                $request->get('id'),
                $request->get('name'),
                new \DateTime($request->get('createdAt'))
            );

            $this->commandBus->dispatch($editCategoryCommand);

            return  new JsonResponse([
                'status' => 'ok',
                'code' => 200,
                'message' => 'The category has been edited with the name: '.$request->get('name')
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