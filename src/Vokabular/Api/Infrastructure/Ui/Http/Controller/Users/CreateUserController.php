<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Users;

use App\Vokabular\Api\Application\Command\Users\CreateUserCommand;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateUserController
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request)
    {
        try {
            $command = new CreateUserCommand(
                $request->get('name'),
                $request->get('email')
            );

            $this->commandBus->dispatch($command);

            return  new JsonResponse([
                'status' => 'ok',
                'code' => 200,
                'message' => 'The user has been created with the name: '.$request->get('name'),
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