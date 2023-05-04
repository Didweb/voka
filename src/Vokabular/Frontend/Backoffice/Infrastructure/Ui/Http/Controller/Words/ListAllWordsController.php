<?php

namespace App\Vokabular\Frontend\Backoffice\Infrastructure\Ui\Http\Controller\Words;

use App\Vokabular\Frontend\Backoffice\Application\Query\Words\ListAllWordsQuery;
use App\Vokabular\Frontend\Backoffice\Infrastructure\Form\ChangeImageWordType;
use App\Vokabular\Frontend\Backoffice\Infrastructure\Form\EditWordType;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListAllWordsController extends AbstractController
{

    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): Response
    {
        $page = $request->get('page', 1);
        $pagination = [
            'page' => $page
        ];
        $formEdit = $this->createForm(EditWordType::class);
        $formChangeImage = $this->createForm(ChangeImageWordType::class);

        $response = $this->queryBus->ask(new ListAllWordsQuery($pagination));

        return $this->render('@frontend_office/words/listAllWords.html.twig', [
            'titleH1' => 'All Words',
            'allWords' => $response->allWords(),
            'pagination' => $response->pagination(),
            'formEdit' => $formEdit->createView(),
            'formChangeImage' => $formChangeImage->createView()
        ]);
    }
}