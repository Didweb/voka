<?php

namespace App\Vokabular\Frontend\Frontoffice\Domain\Model\Training;

class RouteTrainingWord
{

    public function __construct(
        private int $keyWord,
        private int $shown,
        private int $percentageViews,
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

    public function addShown(): void
    {
        $this->shown = $this->shown + 1;
    }

    public function updatePercentageViews($value): void
    {
        $this->percentageViews = $value;
    }

    public function percentageViews(): int
    {
        return $this->percentageViews;
    }

    public static function toArray(RouteTrainingWord $routeTrainingWord): array
    {
        return [
            'keyWord' =>            $routeTrainingWord->keyWord(),
            'shown' =>              $routeTrainingWord->shown(),
            'percentageViews' =>    $routeTrainingWord->percentageViews()
        ];
    }

    public static function fromArray(array $routeTrainingWord): self
    {
        return new RouteTrainingWord(
                    $routeTrainingWord['keyWord'],
                    $routeTrainingWord['shown'],
                    $routeTrainingWord['percentageViews']
                );
    }


}