<?php

namespace App\Vokabular\Api\Application\Query\Categories;

use App\Vokabular\Api\Domain\Model\Categories\CategoryRepository;
use App\Vokabular\Api\Shared\Domain\Bus\Query\QueryHandler;

class FindCategoryByName implements QueryHandler
{

    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(FindCategoryByNameQuery $query)
    {

        return $this->categoryRepository->findByName(
            $query->name()
        );
    }

}