<?php

namespace App\Vokabular\Frontend\Frontoffice\Domain\Model\Training;

class RouteTraining
{

    public function __construct(
        private int $currentWord = 0,
        private int $loop = 1,
        private ?RouteTrainingWordCollection $routeTrainingWordCollection = null
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

    public function routeTrainingWordCollection(): ?RouteTrainingWordCollection
    {
        return $this->routeTrainingWordCollection;
    }



    public function toArray(): array
    {
        $routeWordCollection = null;

        if($this->routeTrainingWordCollection() != null) {
            $routeWordCollection = $this->routeTrainingWordCollection()->toArray();
        }

        return [
            'currentWord' => $this->currentWord(),
            'loop' => $this->loop(),
            'routeTrainingCollection' => $routeWordCollection,
        ];
    }

    public function initWordsCollection($n_words): array
    {
        $allTrainingWords = [];
        for($n=0;$n<$n_words;$n++) {
            $initFirst = ($n==0)?1:0;
            $allTrainingWords[$n] = new RouteTrainingWord(
                $n,
                $initFirst,
                0,
            );
        }
        $this->routeTrainingWordCollection = new RouteTrainingWordCollection($allTrainingWords);
        return $allTrainingWords;
    }

    public function calculateNextWord($n_words): void
    {
        $totalWords = count($n_words);

        $routes = $this->routeTrainingWordCollection();
        $routesArr = $routes->getCollection();

        $this->incrementRouteWord($routesArr, $routes);
        $this->searchRandomWord($totalWords, $routesArr);
        $this->incrementLoop($totalWords);

    }

    private function searchRandomWord(int $n_words, array $routesArr): void
    {
        $n_words = ($n_words<5)?5:$n_words;
        $arrWords = array_map(function($word) {
            return $word->percentageViews();
        }, $routesArr);

        asort($arrWords);
        $arrToCheck = $arrWords;
        $max = $n_words-1;

        if ($n_words > 4) {
            $cut = round($n_words/2);
            $max = $max - $cut;
            $arrToCheck = array_slice($arrWords, 0,$cut, true);
        }
        $newArr = array_keys($arrToCheck);

        do {
            $randWord = rand(0, $max);
        } while ($randWord == $this->currentWord
                    && isset($newArr[$randWord]));

        $this->currentWord = $newArr[$randWord];
    }

    private function incrementRouteWord(array $routesArr,RouteTrainingWordCollection  $routes): void
    {

        $routeWord = $routesArr[$this->currentWord()];
        $routeWord->addShown();
        $routes->set($this->currentWord(), $routeWord);

        $totalViews = 0;
        foreach($routesArr as $item) {
            $totalViews = $totalViews + $item->shown();
        }

        foreach($routesArr as $key => $item) {
            $percent = (int)($item->shown()*100)/$totalViews;
            $item->updatePercentageViews($percent);
            $routes->set($key, $item);
        }


    }

    private function incrementLoop($n_words): void
    {
        if($this->loop <= $n_words) {
            $this->loop = $this->loop + 1;
        }

        if($this->loop > $n_words) {
            $this->loop = 1;
        }
    }

}