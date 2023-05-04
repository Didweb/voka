<?php

namespace App\Vokabular\Api\Domain\Service;

interface IdStringGenerator
{
    public function generate(): string;
}