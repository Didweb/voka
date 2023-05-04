<?php

namespace App\Vokabular\Frontend\Frontoffice\Infrastructure\Ui\Http\Controller\Others;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WhatIsThisController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('@frontend_front/others/what-is-this.html.twig');
    }
}