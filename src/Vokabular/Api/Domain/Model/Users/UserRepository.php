<?php

namespace App\Vokabular\Api\Domain\Model\Users;

use App\Vokabular\Api\Application\Command\Users\EditUserCommand;
use App\Vokabular\Api\Application\Response\Users\UserResponse;

interface UserRepository
{
    public function insert(User $user): void;

    public function findByEmail(string $email): UserResponse;

    public function delete(string $id): void;

    public function edit(EditUserCommand $user): void;
}