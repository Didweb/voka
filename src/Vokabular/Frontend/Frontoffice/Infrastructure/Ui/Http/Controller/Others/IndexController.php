<?php

namespace App\Vokabular\Frontend\Frontoffice\Infrastructure\Ui\Http\Controller\Others;

use App\Vokabular\Frontend\Frontoffice\Infrastructure\Form\SetupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{


    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(SetupType::class);

        return $this->render('@frontend_front/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}