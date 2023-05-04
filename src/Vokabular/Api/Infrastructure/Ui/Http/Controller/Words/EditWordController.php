<?php

namespace App\Vokabular\Api\Infrastructure\Ui\Http\Controller\Words;

use App\Vokabular\Api\Application\Command\Words\EditWordCommand;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EditWordController
{

    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {

            $editWordCommand = new EditWordCommand(
                $request->get('id'),
                $request->get('word'),
                $request->get('gender'),
                $request->get('level'),
                $request->get('category')
            );

            $this->commandBus->dispatch($editWordCommand);

            return  new JsonResponse([
                'status' => 'ok',
                'code' => 200,
                'message' => 'The word has been edited with the name: '.$request->get('word')
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