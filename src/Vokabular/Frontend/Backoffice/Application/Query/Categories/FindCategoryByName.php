<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Query\Categories;

use App\Vokabular\Frontend\Backoffice\Application\Response\Categories\FindCategoryByNameResponse;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryHandler;
use App\Vokabular\Frontend\Shared\Infrastructure\Service\CurlQueryConnect;

class FindCategoryByName implements QueryHandler
{

    public function __construct(private CurlQueryConnect $curlQueryConnect)
    {
    }

    public function __invoke(FindCategoryByNameQuery $query)
    {
       $result =  $this->curlQueryConnect->curl('/find-by-name/category?name='.$query->name());

        return new FindCategoryByNameResponse($result['found']);
    }
}