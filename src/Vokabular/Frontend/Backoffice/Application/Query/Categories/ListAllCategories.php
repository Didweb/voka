<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Query\Categories;

use App\Vokabular\Frontend\Backoffice\Application\Response\Categories\ListAllCategoriesResponse;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryHandler;
use App\Vokabular\Frontend\Shared\Infrastructure\Service\CurlQueryConnect;

class ListAllCategories implements QueryHandler
{

    public function __construct(private CurlQueryConnect $curlQueryConnect)
    {
    }

    public function __invoke(ListAllCategoriesQuery $listAllCategories)
    {
        $result =  $this->curlQueryConnect->curl('/find-all/categories');

        return new ListAllCategoriesResponse($result);
    }
}