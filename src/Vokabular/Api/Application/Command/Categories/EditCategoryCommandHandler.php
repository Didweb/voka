<?php

namespace App\Vokabular\Api\Application\Command\Categories;

use App\Vokabular\Api\Domain\Model\Categories\Category;
use App\Vokabular\Api\Domain\Model\Categories\CategoryRepository;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandHandler;

class EditCategoryCommandHandler implements CommandHandler
{

    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(EditCategoryCommand $editCategoryCommand)
    {


        $this->categoryRepository->update( $editCategoryCommand);
    }
}