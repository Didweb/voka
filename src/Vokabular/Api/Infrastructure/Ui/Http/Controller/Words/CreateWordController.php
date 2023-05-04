<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Words;

use App\Vokabular\Api\Application\Command\Words\CreateWordCommand;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateWordController
{

    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {

            $command = new CreateWordCommand(
                $request->get('word'),
                $request->get('image'),
                $request->get('gender'),
                $request->get('level'),
                $request->get('category'),
            );
            $this->commandBus->dispatch($command);

            return  new JsonResponse([
                'status' => 'ok',
                'code' => 200,
                'message' => 'The word has been created with the name: ',
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