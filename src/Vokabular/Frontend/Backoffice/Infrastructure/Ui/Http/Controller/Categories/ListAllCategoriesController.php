<?php

namespace App\Vokabular\Frontend\Backoffice\Infrastructure\Ui\Http\Controller\Categories;

use App\Vokabular\Frontend\Backoffice\Application\Query\Categories\ListAllCategoriesQuery;
use App\Vokabular\Frontend\Backoffice\Infrastructure\Form\EditCategoryType;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListAllCategoriesController  extends AbstractController
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(): Response
    {

        $formEdit = $this->createForm(EditCategoryType::class);

        $allCategories =  $this->queryBus->ask(new ListAllCategoriesQuery());

        return $this->render('@frontend_office/categories/listAllCategories.html.twig', [
            'titleH1' => 'All Categories',
            'allCategories' => $allCategories,
            'formEdit' => $formEdit->createView()
        ]);
    }
}