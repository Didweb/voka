<?php

namespace App\Vokabular\Api\Domain\Model\Users;

use App\Vokabular\Api\Domain\Model\Users\ValueObjects\UserTrainingId;
use App\Vokabular\Api\Domain\Model\Words\Word;

class UserTraining
{
    private UserTrainingId $id;
    private Word $word;
    private int $hits = 0;
    private int $failures = 0;
    private bool $overcome = false;
    private User $user;

    public function __construct(UserTrainingId $id,
                                Word $word,
                                User $user,
                                int $hits = 0,
                                int $failures = 0,
    )
    {
        $this->id = $id;
        $this->word = $word;
        $this->user = $user;
        $this->hits = $hits;
        $this->failures = $failures;
        $this->updateOvercome();
    }

    private function updateOvercome()
    {
       if ($this->hits > 4 ){
           $this->overcome =  true;
       }
    }

    public function updateHit()
    {
        $this->hits = $this->hits + 1;
        $this->updateOvercome();
    }

    public function updateFailure()
    {
        $this->failures = $this->failures + 1;
        $this->updateOvercome();
    }

    public function id(): UserTrainingId
    {
        return $this->id;
    }

    public function word(): Word
    {
        return $this->word;
    }

    public function hits(): int
    {
        return $this->hits;
    }

    public function failures(): int
    {
        return $this->failures;
    }

    public function overcome(): bool
    {
        return $this->overcome;
    }

    public function user(): User
    {
        return $this->user;
    }

    public static function fromArray(array $array): UserTraining
    {
        $word = Word::fromArray($array['word']);
        return new UserTraining(
            UserTrainingId::create($array['id']),
            $word,
            $array['hits'],
            $array['failures']
        );

    }

    public static function toArray(UserTraining $userTraining): array
    {
        return [
            'id' => $userTraining->id()->value(),
            'word' => $userTraining->word()->__toArray(),
            'hits' => $userTraining->hits(),
            'failures' => $userTraining->failures(),
            'overcome' => $userTraining->overcome()
        ];
    }
}