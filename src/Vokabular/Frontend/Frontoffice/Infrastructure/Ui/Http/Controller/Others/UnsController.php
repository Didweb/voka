<?php

namespace App\Vokabular\Frontend\Frontoffice\Infrastructure\Ui\Http\Controller\Others;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UnsController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('@frontend_front/others/uns.html.twig');
    }
}