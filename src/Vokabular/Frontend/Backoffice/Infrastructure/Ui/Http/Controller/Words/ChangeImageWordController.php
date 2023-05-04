<?php

namespace App\Vokabular\Frontend\Backoffice\Infrastructure\Ui\Http\Controller\Words;

use App\Vokabular\Frontend\Backoffice\Application\Command\Words\ChangeImageWordCommand;
use App\Vokabular\Frontend\Backoffice\Infrastructure\Form\ChangeImageWordType;
use App\Vokabular\Frontend\Backoffice\Infrastructure\Form\EditWordType;
use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeImageWordController extends AbstractController
{

    public function __construct(
        private CommandBus $commandBus,
        private string $pathPublicImages)
    {
    }

    public function __invoke(Request $request): Response
    {
        $formEdit = $this->createForm(EditWordType::class);
        $formChangeImage = $this->createForm(ChangeImageWordType::class);
        $formChangeImage->handleRequest($request);

        try {

            if ($formChangeImage->isSubmitted() && $formChangeImage->isValid()) {
                $imageFile = $formChangeImage->get('image')->getData();
                $oldName = $formChangeImage->get('oldName')->getData();

                if(!$imageFile) {
                    $this->addFlash('danger', 'Not File Image ');

                    return $this->render('@frontend_office/words/changeImageWord.html.twig', [
                        'titleH1' => 'Change Image'
                    ]);
                }

                unlink($this->pathPublicImages.$oldName);
                $newFilename = Uuid::uuid4().'.'.$imageFile->guessExtension();
                move_uploaded_file($imageFile, $this->pathPublicImages.$newFilename);


                $this->commandBus->dispatch(new ChangeImageWordCommand(
                    $formChangeImage->getData()['id'],
                    $newFilename
                ));

            }
            $this->addFlash('success', 'Changed Image');
            return $this->render('@frontend_office/words/changeImageWord.html.twig', [
                'titleH1' => 'Change Image'
            ]);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}