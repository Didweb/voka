<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Words;

use App\Vokabular\Api\Application\Command\Words\ChangeImageWordCommand;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ChangeImageWordController
{

    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try{

            $command = new ChangeImageWordCommand(
                $request->get('id'),
                $request->get('image')
            );

            $this->commandBus->dispatch($command);

            return  new JsonResponse([
                'status' => 'ok',
                'code' => 200,
                'message' => 'Change image to the word with id:'.$request->get('id')
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