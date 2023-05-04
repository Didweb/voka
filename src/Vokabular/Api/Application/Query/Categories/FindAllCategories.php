<?php

namespace App\Vokabular\Api\Application\Query\Categories;

use App\Vokabular\Api\Domain\Model\Categories\CategoryRepository;
use App\Vokabular\Api\Shared\Domain\Bus\Query\QueryHandler;

class FindAllCategories implements QueryHandler
{

    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(FindAllCategoriesQuery $findAllCategoriesQuery)
    {

        return $this->categoryRepository->findAll();
    }
}