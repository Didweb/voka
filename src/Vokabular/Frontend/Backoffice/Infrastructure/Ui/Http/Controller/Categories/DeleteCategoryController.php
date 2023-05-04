<?php

namespace App\Vokabular\Frontend\Backoffice\Infrastructure\Ui\Http\Controller\Categories;

use App\Vokabular\Frontend\Backoffice\Application\Command\Categories\DeleteCategoryCommand;
use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandBus;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteCategoryController extends AbstractController
{

    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request): Response
    {

        try {
            $this->commandBus->dispatch(
                new DeleteCategoryCommand($request->get('id'))
            );
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $this->render('@frontend_office/categories/deleteCategory.html.twig', [
            'titleH1' => 'Delete Category'
        ]);
    }
}