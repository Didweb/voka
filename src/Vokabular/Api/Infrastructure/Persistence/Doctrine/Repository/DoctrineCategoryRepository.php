<?php

namespace App\Vokabular\Api\Infrastructure\Persistence\Doctrine\Repository;


use App\Vokabular\Api\Application\Command\Categories\EditCategoryCommand;
use App\Vokabular\Api\Application\Response\Categories\CategoryCollectionResponse;
use App\Vokabular\Api\Application\Response\Categories\CategoryResponse;
use App\Vokabular\Api\Domain\Model\Categories\Category;
use App\Vokabular\Api\Domain\Model\Categories\CategoryCollection;
use App\Vokabular\Api\Domain\Model\Categories\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Exception;

class DoctrineCategoryRepository   implements CategoryRepository
{

    private EntityManagerInterface $em;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Category::class);
    }

    public function insert(Category $category): void
    {
        $this->em->persist($category);
        $this->em->flush();
    }


    public function findAll(): CategoryCollectionResponse
    {

        $categoryFind = $this->repository->findBy([], ['name' => 'ASC']);

        $categoryCollection = CategoryCollection::init();
        if (!empty($categoryFind)) {
            foreach ($categoryFind as $category) {

                $categoryDomain = Category::fromInfrastructure($category);
                $categoryResponse = new CategoryResponse($categoryDomain);
                $categoryCollection->add($categoryResponse);
            }
        }

        return new CategoryCollectionResponse($categoryCollection);
    }

    public function findByName(string $name): CategoryCollectionResponse
    {
        /** @var Category $category */
        $categoryFind = $this->repository->findBy(
            ['name'=> $name]
        );

        $categoryCollection = CategoryCollection::init();

        if (!empty($categoryFind)) {
            foreach ($categoryFind as $category) {

                $categoryDomain = Category::fromInfrastructure($category);
                $categoryResponse = new CategoryResponse($categoryDomain);
                $categoryCollection->add($categoryResponse);
            }
        }
        return new CategoryCollectionResponse($categoryCollection);
    }

    public function delete(string $id): void
    {
        $category = $this->em->getRepository(Category::class)->find(['id'=>$id]);

        if (!$category) {
            throw new Exception('No category found for id '.$id);
        }

        $this->em->remove($category);
        $this->em->flush();
    }

    public function update(EditCategoryCommand $category): void
    {

        $categoryByName = $this->repository->findBy(
            ['name'=> $category->name()]
        );

        if ($categoryByName) {
            throw new Exception('Duplicate Name '.$category->name());
        }

        $categoryById = $this->repository->findBy(
            ['id'=> $category->id()]
        );

        if (!$categoryById) {
            throw new Exception('No category found for id '.$category->id());
        }


        $queryBuilder = $this->em->createQueryBuilder();
        $query = $queryBuilder->update(Category::class, 'c')
            ->set('c.name', ':name')
            ->set('c.updatedAt', ':updatedAt')
            ->where('c.id = :id')
            ->setParameter('name', $category->name())
            ->setParameter('updatedAt', new \DateTime())
            ->setParameter('id', $category->id())
            ->getQuery();

        $query->execute();
    }
}