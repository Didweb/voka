<?php

namespace App\Vokabular\Api\Application\Command\Users;

use App\Vokabular\Api\Domain\Model\Users\UserRepository;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandHandler;

class EditUserCommandHandler implements CommandHandler
{


    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(EditUserCommand $command)
    {
        $this->userRepository->edit($command);
    }
}