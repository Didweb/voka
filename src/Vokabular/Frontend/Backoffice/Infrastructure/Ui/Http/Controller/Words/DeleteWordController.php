<?php

namespace App\Vokabular\Frontend\Backoffice\Infrastructure\Ui\Http\Controller\Words;

use App\Vokabular\Frontend\Backoffice\Application\Command\Words\DeleteWordCommand;
use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandBus;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteWordController extends AbstractController
{

    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): Response
    {
        try {
            $this->commandBus->dispatch(
                new DeleteWordCommand(
                    $request->get('id'),
                    $request->get('image')
                )
            );
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $this->render('@frontend_office/words/deleteWord.html.twig', [
            'titleH1' => 'Delete Category'
        ]);
    }
}