<?php

namespace App\Vokabular\Api\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineRepository
{
    protected EntityRepository $repository;
    protected EntityManager $entityManager;
    protected string $table;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository($this->entityClassName());
    }

    abstract protected function entityClassName(): string;
}