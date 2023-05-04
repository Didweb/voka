<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Words;

use App\Vokabular\Api\Application\Command\Words\DeleteWordCommand;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DeleteWordController
{

    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {

        $this->commandBus->dispatch(
            new DeleteWordCommand($request->get('id'))
        );

        try {
            return  new JsonResponse([
                'status' => 'ok',
                'code' => 200,
                'message' => 'Word has been successfully removed.',
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