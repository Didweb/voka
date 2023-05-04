<?php

namespace App\Vokabular\Api\Application\Query\Words;

use App\Vokabular\Api\Application\Response\Words\WordCollectionResponse;
use App\Vokabular\Api\Domain\Model\Categories\CategoryCollection;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Level;
use App\Vokabular\Api\Domain\Model\Words\WordRepository;
use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Api\Shared\Domain\Bus\Query\QueryHandler;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\SetUp\Setup;

class GetWordsFromSetup implements QueryHandler
{

    public function __construct(private WordRepository $wordRepository)
    {
    }

    public function __invoke(GetWordsFromSetupQuery $query)
    {

        $setUp = new Setup(
            $query->n_words(),
            $query->level(),
            $query->category()
        );

        return $this->wordRepository->findWordsFromSetup($setUp);
    }
}