<?php

namespace App\Vokabular\Api\Domain\Model\Users;

interface UserRepository
{
    public function insert(User $user): void;
}