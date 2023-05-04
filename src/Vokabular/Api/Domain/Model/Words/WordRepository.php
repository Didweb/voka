<?php

namespace App\Vokabular\Api\Domain\Model\Words;

use App\Vokabular\Api\Application\Query\Words\GetWordsFromSetupQuery;
use App\Vokabular\Api\Application\Response\Categories\CategoryCollectionResponse;
use App\Vokabular\Api\Application\Response\Words\WordCollectionResponse;
use App\Vokabular\Api\Domain\Model\Categories\Category;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Level;
use App\Vokabular\Api\Domain\Service\Pagination;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\SetUp\Setup;
use Symfony\Component\HttpFoundation\Response;

interface WordRepository
{
    public function insert(Word $word): void;

    public function updateWord(Word $word): void;

    public function updateWordComplete(Word $word): void;

    public function delete(string $id): void;

    public function updateImage(Word $word): void;

    public function findAll(Pagination $pagination): WordCollectionResponse;

    public function findWordsFromSetup(Setup $setUp): WordCollectionResponse;


}