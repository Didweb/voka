<?php

namespace App\Vokabular\Frontend\Backoffice\Infrastructure\Ui\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminIndexController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('@frontend_office/admin-index.html.twig', [
            'titleH1' => 'Home'
        ]);
    }
}