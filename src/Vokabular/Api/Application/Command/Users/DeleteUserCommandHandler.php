<?php

namespace App\Vokabular\Api\Application\Command\Users;

use App\Vokabular\Api\Domain\Model\Users\UserRepository;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandHandler;

class DeleteUserCommandHandler implements CommandHandler
{

    public function __construct( private UserRepository $userRepository)
    {
    }

    public function __invoke(DeleteUserCommand $command)
    {

        $this->userRepository->delete($command->id());
    }
}