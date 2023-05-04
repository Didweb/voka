<?php

namespace App\Vokabular\Api\Application\Response\Words;

use App\Vokabular\Api\Domain\Model\Words\Word;
use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Api\Domain\Service\Pagination;
use App\Vokabular\Api\Shared\Domain\Bus\Query\Response;

class WordCollectionResponse implements Response
{
    private array $words;
    private ?Pagination $pagination;

    public function __construct(WordsCollection $wordCollection, ?Pagination $pagination = null)
    {
        $this->words = [];
        foreach($wordCollection->getCollection() as $word) {
            $this->words[] = $word;
        }
        $this->pagination = ($pagination!=null)?$pagination:null;
    }
    public function words(): array
    {
        return $this->words;
    }

    public function pagination(): ?Pagination
    {
        return $this->pagination;
    }

    public function toArray()
    {
        return array_map(function ($word){
            return $word->toArray();
        }, $this->words());
    }

    public static function fromArrayCollection(array $WordsArrayCollection): self
    {
        $wordCollection = WordsCollection::init();

        if(!empty($wordFind)) {
            foreach ($wordFind as $word) {
                $wordDomain = Word::fromInfrastructure($word);

                $wordResponse = new WordResponse($wordDomain);
                $wordCollection->add($wordResponse);
            }
        }
        return new WordCollectionResponse($wordCollection);
    }

}