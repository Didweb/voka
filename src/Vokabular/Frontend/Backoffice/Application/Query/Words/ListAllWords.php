<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Query\Words;

use App\Vokabular\Frontend\Backoffice\Application\Response\Words\ListAllWordsResponse;
use App\Vokabular\Frontend\Shared\Domain\Bus\Query\QueryHandler;
use App\Vokabular\Frontend\Shared\Infrastructure\Service\CurlQueryConnect;

class ListAllWords implements QueryHandler
{

    public function __construct(private CurlQueryConnect $curlQueryConnect)
    {
    }

    public function __invoke(ListAllWordsQuery $query)
    {
        $result = $this->curlQueryConnect->curl('/find-all/words?page='.$query->pagination()['page']);

        return new ListAllWordsResponse($result['data'], $result['pagination']);
    }
}