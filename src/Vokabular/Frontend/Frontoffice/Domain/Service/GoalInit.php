<?php

namespace App\Vokabular\Frontend\Frontoffice\Domain\Service;

use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Score\Score;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\SetUp\Setup;

class GoalInit
{
    protected WordsCollection $wordsCollection;
    protected Setup           $setup;

    public function initWordCollectionFromArray(array $arrWordCollection): void
    {
        $wordCollection = new WordsCollection();
        $wordCollection->fromArray($arrWordCollection);

        $this->wordsCollection = $wordCollection;
    }

    public function initSetUpFromArray(array $setup): void
    {
        $setUp = new SetUp(
            $setup['n_words'],
            $setup['level'],
            $setup['category']
        );

        $this->setup = $setUp;
    }




}