<?php

namespace App\Vokabular\Api\Application\Command\Users;

use App\Vokabular\Api\Domain\Model\Users\User;
use App\Vokabular\Api\Domain\Model\Users\UserRepository;
use App\Vokabular\Api\Domain\Model\Users\UserTrainingCollection;
use App\Vokabular\Api\Domain\Model\Users\ValueObjects\UserId;
use App\Vokabular\Api\Domain\Service\IdStringGenerator;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandHandler;

class CreateUserCommandHandler implements CommandHandler
{

    public function __construct(
        private UserRepository $userRepository,
        private IdStringGenerator $idStringGenerator
    )
    {
    }

    public function __invoke(CreateUserCommand $command): void
    {

        $user = new User(
            new UserId($this->idStringGenerator->generate()),
            $command->name(),
            $command->email(),
            null,
            null,
            null
        );

        $this->userRepository->insert($user);
    }
}