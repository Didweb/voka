<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Users;

use App\Vokabular\Api\Application\Command\Users\DeleteUserCommand;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DeleteUserController
{

    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {

            $this->commandBus->dispatch(
                new DeleteUserCommand($request->get('id'))
            );

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