<?php

namespace App\Vokabular\Api\Application\Query\Users;

use App\Vokabular\Api\Application\Response\Users\UserResponse;
use App\Vokabular\Api\Domain\Model\Users\UserRepository;
use App\Vokabular\Api\Shared\Domain\Bus\Query\QueryHandler;

class GetUser implements QueryHandler
{

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(GetUserQuery $query): UserResponse
    {
        $email =  $query->toArray()['email'];
        return $this->userRepository->findByEmail($email);
    }
}