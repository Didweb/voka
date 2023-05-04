<?php

namespace App\Vokabular\Api\Shared\Domain\Bus\Query;


interface QueryBus
{
    public function ask(Query $query): Response;
}