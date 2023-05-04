<?php

namespace App\Vokabular\Api\Application\Command\Categories;

use App\Vokabular\Api\Domain\Model\Categories\CategoryRepository;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandHandler;

class DeleteCategoryCommandHandler implements CommandHandler
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(DeleteCategoryCommand $deleteCategoryCommand): void
    {
        $this->categoryRepository->delete($deleteCategoryCommand->id());
    }
}