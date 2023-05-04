<?php

namespace App\Vokabular\Frontend\Backoffice\Infrastructure\Ui\Http\Controller\Categories;


use App\Vokabular\Frontend\Backoffice\Application\Command\Categories\EditCategoryCommand;
use App\Vokabular\Frontend\Backoffice\Infrastructure\Form\EditCategoryType;
use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditCategoryController extends AbstractController
{

    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): Response
    {
        $formEdit = $this->createForm(EditCategoryType::class);
        $formEdit->handleRequest($request);

        try {
            $this->commandBus->dispatch(new EditCategoryCommand(
                $formEdit->getData()['id'],
                $formEdit->getData()['name'],
                new \DateTime($formEdit->getData()['createdAt'])
            ));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $this->render('@frontend_office/categories/editedCategory.html.twig', [
            'titleH1' => 'Edited Category'
        ]);
    }
}