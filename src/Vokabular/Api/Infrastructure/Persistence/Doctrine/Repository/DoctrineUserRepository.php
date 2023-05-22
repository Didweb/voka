<?php
namespace App\Vokabular\Api\Infrastructure\Persistence\Doctrine\Repository;

use App\Vokabular\Api\Domain\Model\Users\User;
use App\Vokabular\Api\Domain\Model\Users\UserRepository;
use App\Vokabular\Api\Domain\Model\Users\ValueObjects\UserId;
use App\Vokabular\Api\Domain\Model\Words\Word;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Exception;
use Knp\Component\Pager\PaginatorInterface;

class DoctrineUserRepository implements UserRepository
{

    private EntityManagerInterface $em;
    private ObjectRepository $repository;
    private PaginatorInterface $paginator;

    public function __construct(EntityManagerInterface $em, PaginatorInterface $paginator)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Word::class);
        $this->paginator = $paginator;
    }

    public function insert(User $user): void
    {
        $wordFindByName = $this->repository->findBy(['word' => $user->email()]);

        if ($wordFindByName) {
            throw new Exception('Duplicate word: '.$user->email());
        }

        $this->em->persist($user);
        $this->em->flush();
    }
}