<?php
namespace App\Vokabular\Api\Infrastructure\Persistence\Doctrine\Repository;

use App\Vokabular\Api\Application\Response\Users\UserResponse;
use App\Vokabular\Api\Domain\Model\Users\User;
use App\Vokabular\Api\Domain\Model\Users\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Exception;

class DoctrineUserRepository implements UserRepository
{

    private EntityManagerInterface $em;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(User::class);
    }

    public function insert(User $user): void
    {
        $wordFindByName = $this->repository->findBy(['email' => $user->email()]);

        if ($wordFindByName) {
            throw new Exception('Duplicate user: '.$user->email());
        }

        $this->em->persist($user);
        $this->em->flush();
    }

    public function findByEmail($email): UserResponse
    {

        $user = $this->repository->findBy(['email' => $email]);

        $userDomain = User::fromInfrastructure($user[0]);

        return new UserResponse($userDomain);
    }
}