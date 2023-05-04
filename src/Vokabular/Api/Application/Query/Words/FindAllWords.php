<?php

namespace App\Vokabular\Api\Application\Query\Words;

use App\Vokabular\Api\Application\Response\Words\WordCollectionResponse;
use App\Vokabular\Api\Domain\Model\Words\WordRepository;
use App\Vokabular\Api\Domain\Service\Pagination;
use App\Vokabular\Api\Shared\Domain\Bus\Query\QueryHandler;

class FindAllWords implements QueryHandler
{

    public function __construct(private WordRepository $wordRepository)
    {
    }

    public function __invoke(FindAllWordsQuery $query): WordCollectionResponse
    {
        $pagination = new Pagination($query->pagination()['page']);
        return $this->wordRepository->findAll($pagination);
    }
}