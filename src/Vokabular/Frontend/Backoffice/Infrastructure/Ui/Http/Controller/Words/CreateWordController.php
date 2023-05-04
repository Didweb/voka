<?php

namespace App\Vokabular\Frontend\Backoffice\Infrastructure\Ui\Http\Controller\Words;


use App\Vokabular\Frontend\Backoffice\Application\Command\Words\CreateWordCommand;
use App\Vokabular\Frontend\Backoffice\Infrastructure\Form\CreateWordType;
use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateWordController extends AbstractController
{

    public function __construct(
        private CommandBus $commandBus,
        private string $pathPublicImages
    )
    {
    }

    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(CreateWordType::class);
        $form->handleRequest($request);
        $newFilename = '';
        try {

            if ($form->isSubmitted() && $form->isValid()) {


                $imageFile = $form->get('image')->getData();

                if($imageFile) {
                    $newFilename = Uuid::uuid4().'.'.$imageFile->guessExtension();
                    move_uploaded_file($imageFile, $this->pathPublicImages.$newFilename);
                }


                $this->commandBus->dispatch(new CreateWordCommand(
                    $form->getData()['word'],
                    $newFilename,
                    $form->getData()['gender'],
                    $form->getData()['level'],
                    $form->getData()['category']->encode()
                ));
            }


        } catch (\Exception $e) {
           throw new \Exception($e->getMessage());
        }

        return $this->render('@frontend_office/words/createWord.html.twig', [
            'titleH1' => 'Create Word',
            'form' => $form->createView()
        ]);
    }
}