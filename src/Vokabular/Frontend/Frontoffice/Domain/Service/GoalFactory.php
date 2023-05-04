<?php

namespace App\Vokabular\Frontend\Frontoffice\Domain\Service;

use App\Vokabular\Frontend\Frontoffice\Domain\Model\Quiz\GoalQuiz;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Training\GoalTraining;
use InvalidArgumentException;


class GoalFactory
{
    const GOAL_TRAINING =  'TRAINING';
    const GOAL_QUIZ =  'QUIZ';

    public static function create(string $typeGoal)
    {
        switch ($typeGoal) {
            case self::GOAL_TRAINING:
                return new GoalTraining();

            case self::GOAL_QUIZ:
                return new GoalQuiz();

            default:
                throw new InvalidArgumentException("The model you requested doesn't exist");
        }
    }
}