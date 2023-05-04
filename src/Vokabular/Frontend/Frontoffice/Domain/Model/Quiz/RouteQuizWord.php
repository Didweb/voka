<?php

namespace App\Vokabular\Frontend\Frontoffice\Domain\Model\Quiz;

class RouteQuizWord
{

    public function __construct(
        private int $keyWord,
        private int $shown,
        private int $percentageViews,
        private int $hits,
        private int $failures
    )
    {
    }

    public function keyWord(): int
    {
        return $this->keyWord;
    }

    public function shown(): int
    {
        return $this->shown;
    }

    public function percentageViews(): int
    {
        return $this->percentageViews;
    }

    public function hits(): int
    {
        return $this->hits;
    }

    public function failures(): int
    {
        return $this->failures;
    }

    public static function toArray(RouteQuizWord $routeQuizWord): array
    {
        return [
            'keyWord' => $routeQuizWord->keyWord(),
            'shown' => $routeQuizWord->shown(),
            'percentageViews' => $routeQuizWord->percentageViews(),
            'hits' => $routeQuizWord->hits(),
            'failures' => $routeQuizWord->failures()
        ];
    }

    public static function fromArray(array $routeTrainingWord): self
    {
        return new RouteQuizWord(
            $routeTrainingWord['keyWord'],
            $routeTrainingWord['shown'],
            $routeTrainingWord['percentageViews'],
            $routeTrainingWord['hits'],
            $routeTrainingWord['failures']
        );
    }
}