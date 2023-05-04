<?php

namespace App\Vokabular\Frontend\Frontoffice\Domain\Model\Training;

use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Training\GetNextWordQuery;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Training\StartTrainingFromQuizQuery;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\SetUp\Setup;
use App\Vokabular\Frontend\Frontoffice\Domain\Service\Goal;
use App\Vokabular\Frontend\Frontoffice\Domain\Service\GoalInit;

class GoalTraining  extends GoalInit implements Goal
{

    private ?RouteTraining   $routeTraining;
    const  PATH_TO_TEMPLATE = '@frontend_front/training/training.html.twig';
    const  PATH_TO_TEMPLATE_NEXTWORD = '@frontend_front/training/next-word.html.twig';
    const  PATH_TO_TEMPLATE_STARTFROMQUIZ = '@frontend_front/training/startFromQuiz.html.twig';

    public function create(
            WordsCollection $wordsCollection,
            Setup           $setup,
            ?RouteTraining $routeTraining
    ): self
    {
        $this->wordsCollection = $wordsCollection;
        $this->setup = $setup;
        if($routeTraining == null) {
            $routeTraining = new RouteTraining(0,1,null);
        }
        $this->routeTraining = $routeTraining;

        return $this;
    }

    public function wordsCollection(): WordsCollection
    {
        return $this->wordsCollection;
    }

    public function setup(): Setup
    {
        return $this->setup;
    }

    public function routeTraining(): ?RouteTraining
    {
        return $this->routeTraining;
    }

    public function route(): RouteTraining
    {
        return $this->routeTraining;
    }

    public function pathToTemplate(): string
    {
        return self::PATH_TO_TEMPLATE;
    }

    public function pathToTemplateNextWord(): string
    {
        return self::PATH_TO_TEMPLATE_NEXTWORD;
    }

    public function pathToTemplateStartFromQuiz(): string
    {
        return self::PATH_TO_TEMPLATE_STARTFROMQUIZ;
    }
    public function initRouteTrainingVoid(): void
    {
        $this->routeTraining =  new RouteTraining();
    }

    public function initRouteTrainingFromArray(array $query): void
    {
        $routeWordCollection = new RouteTrainingWordCollection();

        $route = new RouteTraining(
            $query['currentWord'],
            $query['loop'],
            $routeWordCollection->fromArray($query['routeTrainingCollection'])
        );

        $this->routeTraining = $route;
    }

    public function initGoalSetUp($words): void
    {
        $this->initWordCollectionFromArray($words);
        $this->initRouteTrainingVoid();
        $this->routeTraining()->initWordsCollection($this->wordsCollection()->count());
    }

    public function nextWordTraining(GetNextWordQuery $query): void
    {
        $this->initWordCollectionFromArray($query->wordCollection());
        $this->initSetUpFromArray($query->setup());
        $this->initRouteTrainingFromArray($query->route());

        $this->routeTraining()->calculateNextWord($query->wordCollection());
    }

    public function initTrainingFormQuiz(StartTrainingFromQuizQuery $query): void
    {
        $this->initWordCollectionFromArray($query->wordCollection());
        $this->initRouteTrainingVoid();
        $this->initSetUpFromArray($query->setup());
        $this->routeTraining()->initWordsCollection($this->wordsCollection()->count());
    }
}