<?php

namespace App\Vokabular\Api\Domain\Model\Users;

use App\Vokabular\Api\Application\Response\Users\UserResponse;

interface UserRepository
{
    public function insert(User $user): void;

    public function findByEmail(string $email): UserResponse;
}