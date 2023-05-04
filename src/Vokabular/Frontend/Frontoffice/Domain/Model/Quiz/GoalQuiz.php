<?php

namespace App\Vokabular\Frontend\Frontoffice\Domain\Model\Quiz;

use App\Vokabular\Api\Domain\Model\Words\Word;
use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz\NextWordQuizQuery;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz\ReturnResultOptionQuizQuery;
use App\Vokabular\Frontend\Frontoffice\Application\Query\Quiz\StartQuizQuery;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Score\Score;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\SetUp\Setup;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Training\RouteTraining;
use App\Vokabular\Frontend\Frontoffice\Domain\Service\Goal;
use App\Vokabular\Frontend\Frontoffice\Domain\Service\GoalInit;

class GoalQuiz extends GoalInit implements Goal
{

    protected Score           $score;
    private ?RouteQuiz       $routeQuiz;
    private bool             $currentResultOption = false;
    const  PATH_TO_TEMPLATE = '@frontend_front/quiz/quiz.html.twig';
    const  PATH_TO_TEMPLATE_NEXTWORD = '@frontend_front/quiz/next-word-quiz.html.twig';

    public function create(
                    WordsCollection $wordsCollection,
                    Setup $setup
    ):self
    {
        $this->wordsCollection = $wordsCollection;
        $this->setup = $setup;
        $this->score = new Score();
        $this->routeQuiz = new RouteQuiz();
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

    public function pathToTemplate(): string
    {
        return self::PATH_TO_TEMPLATE;
    }

    public function pathToTemplateNextWord(): string
    {
        return self::PATH_TO_TEMPLATE_NEXTWORD;
    }

    public function score(): Score
    {
        return $this->score;
    }

    public function routeQuiz(): ?RouteQuiz
    {
        return $this->routeQuiz;
    }

    public function route(): RouteQuiz
    {
        return $this->routeQuiz;
    }

    public function currentResultOption(): bool
    {
        return $this->currentResultOption;
    }

    public function initRouteQuizVoid(): void
    {
        $this->routeQuiz =  new RouteQuiz();
    }

    public function initRouteQuizFromArray(array $query): void
    {
        $routeWordCollection = new RouteQuizWordCollection();

        $route = new RouteQuiz(
            $query['currentWord'],
            $query['loop'],
            $query['isEnd'],
            $routeWordCollection->fromArray($query['routeQuizCollection'])
        );

        $this->routeQuiz = $route;
    }


    public function initScoreFromArray(array $score): void
    {
        $score = new Score($score['hits'], $score['failure'], $score['hitPercentage']);
        $this->score = $score;
    }

    public function initScoreStart(): void
    {
        $score = new Score(0, 0, 0);
        $this->score = $score;
    }

    public function checkOptionQuiz($option, $key): void
    {
        $word = $this->wordsCollection()->get($key);

        $this->currentResultOption = ($word->gender()->__toString() === $option);
    }

    public function getWordResult(): array
    {
        $words = $this->wordsCollection()->getCollection();

        return $words[$this->routeQuiz()->currentWord()]->__toArray();
    }

    public function initGoalSetUp(array $words): void
    {
        $this->initWordCollectionFromArray($words);
        $this->initRouteQuizVoid();
        $this->initScoreStart();
        $this->routeQuiz()->initWordsCollection($this->wordsCollection()->count());
    }

    public function initGoalStartQuiz(StartQuizQuery $query): void
    {
        $this->initWordCollectionFromArray($query->wordCollection());
        $this->initSetUpFromArray($query->setup());
        $this->initRouteQuizVoid();
        $this->initScoreStart();
        $this->routeQuiz()->initWordsCollection($this->wordsCollection()->count());
    }

    public function nextWord(NextWordQuizQuery $query): void
    {
        $this->initWordCollectionFromArray($query->wordCollection());
        $this->initSetUpFromArray($query->setup());
        $this->initRouteQuizFromArray($query->route());
        $this->initScoreFromArray($query->score());

        $totalWords = $this->wordsCollection()->count();
        $this->routeQuiz()->updateCurrentWordAndLoop($totalWords);
    }

    public function checkAndUpdateOptionQuiz(ReturnResultOptionQuizQuery $query): void
    {
        $this->initWordCollectionFromArray($query->wordsCollection());
        $this->initRouteQuizFromArray($query->route());
        $this->initScoreFromArray($query->score());
        $this->initSetUpFromArray($query->setup());

        $this->checkOptionQuiz($query->option(), $query->wordPosition());
        $this->score()->updateScore($this->currentResultOption());
    }

}