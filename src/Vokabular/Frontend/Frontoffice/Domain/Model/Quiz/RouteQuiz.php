<?php

namespace App\Vokabular\Frontend\Frontoffice\Domain\Model\Quiz;

class RouteQuiz
{

    public function __construct(
        private int $currentWord = 0,
        private int $loop = 1,
        private bool $isEnd = false,
        private ?RouteQuizWordCollection $routeQuizWordCollection = null
    )
    {
    }

    public function currentWord(): int
    {
        return $this->currentWord;
    }

    public function loop(): int
    {
        return $this->loop;
    }

    public function routeQuizWordCollection(): ?RouteQuizWordCollection
    {
        return $this->routeQuizWordCollection;
    }

    public function isEnd(): bool
    {
        return $this->isEnd;
    }

    public function toArray(): array
    {

        $routeWordCollection = $this->routeQuizWordCollection()->toArray();


        return [
            'currentWord' => $this->currentWord(),
            'loop' => $this->loop(),
            'isEnd' => $this->isEnd(),
            'routeQuizCollection' => $routeWordCollection,
        ];
    }

    public function initWordsCollection($n_words): void
    {
        $allQuizWords = [];

        for($n=0; $n<$n_words; $n++) {
            $initFirst = ($n==0)?1:0;
            $allQuizWords[$n] = new RouteQuizWord(
                $n,
                $initFirst,
                0,
                0,
                0
            );
        }

        $this->routeQuizWordCollection = new RouteQuizWordCollection($allQuizWords);

    }

    public function updateCurrentWordAndLoop($totalWords): void
    {
        if ($this->currentWord + 1 >= $totalWords -1) {
                $this->isEnd = true;
        }

        if ($this->currentWord + 1 < $totalWords -1) {
            $this->currentWord = $this->currentWord + 1;
        }

        $this->loop = $this->loop + 1;
    }

}