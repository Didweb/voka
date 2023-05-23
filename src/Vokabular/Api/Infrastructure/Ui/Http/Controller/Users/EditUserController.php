<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Users;


use App\Vokabular\Api\Application\Command\Users\EditUserCommand;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EditUserController
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {

            $this->commandBus->dispatch(
                new EditUserCommand(
                    $request->get('id'),
                    $request->get('name')
                )
            );

            return  new JsonResponse([
                'status' => 'ok',
                'code' => 200,
                'message' => 'User has been successfully edited.',
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