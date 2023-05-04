<?php

namespace App\Vokabular\Frontend\Backoffice\Infrastructure\Ui\Http\Controller\Words;

use App\Vokabular\Frontend\Backoffice\Application\Command\Words\EditWordCommand;
use App\Vokabular\Frontend\Backoffice\Infrastructure\Form\EditWordType;
use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditWordController extends AbstractController
{

    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): Response
    {
        $formEdit = $this->createForm(EditWordType::class);
        $formEdit->handleRequest($request);

        try {

            $command = new EditWordCommand(
                $formEdit->getData()['id'],
                $formEdit->getData()['word'],
                $formEdit->getData()['gender'],
                $formEdit->getData()['level'],
                json_encode($formEdit->getData()['category']->toArray())
            );

            $this->commandBus->dispatch($command);

            $this->addFlash('success', 'Updated : '.$formEdit->getData()['word']);

            return $this->render('@frontend_office/words/editedWord.html.twig', [
                'titleH1' => 'Edited Category'
            ]);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }
}