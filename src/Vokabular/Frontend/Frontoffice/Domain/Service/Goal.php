<?php

namespace App\Vokabular\Frontend\Frontoffice\Domain\Service;

use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Frontend\Frontoffice\Application\Query\SetUp\FindWordsFromSetupQuery;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Quiz\RouteQuiz;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\SetUp\Setup;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Training\RouteTraining;

interface Goal
{
    public function wordsCollection(): WordsCollection;

    public function Setup(): Setup;

    public function pathToTemplate(): string;

    public function initGoalSetUp(array $words): void;

    public function route(): RouteTraining|RouteQuiz;
}