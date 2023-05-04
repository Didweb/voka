<?php

namespace App\Vokabular\Frontend\Shared\Domain\Bus\Query;

interface QueryBus
{
    public function ask(Query $query): Response;
}