<?php

namespace App\Tests\Frontend\Frontoffice\Model\Service;

use App\Vokabular\Frontend\Frontoffice\Domain\Model\Quiz\GoalQuiz;
use App\Vokabular\Frontend\Frontoffice\Domain\Model\Training\GoalTraining;
use App\Vokabular\Frontend\Frontoffice\Domain\Service\GoalFactory;
use Monolog\Test\TestCase;

class GoalFactoryTest extends TestCase
{
    public function testGoalFactoryReturnTraining()
    {
        $goalTraining = GoalFactory::create('TRAINING');
        $this->assertInstanceOf(GoalTraining::class, $goalTraining);
    }

    public function testGoalFactoryReturnQuiz()
    {
        $goalTraining = GoalFactory::create('QUIZ');
        $this->assertInstanceOf(GoalQuiz::class, $goalTraining);
    }
}