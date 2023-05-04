<?php

namespace App\Vokabular\Api\Application\Command\Categories;

use App\Vokabular\Api\Domain\Model\Categories\Category;
use App\Vokabular\Api\Domain\Model\Categories\CategoryRepository;
use App\Vokabular\Api\Domain\Model\Categories\ValuesObject\CategoryId;
use App\Vokabular\Api\Domain\Service\IdStringGenerator;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandHandler;

class CreateCategoryCommandHandler implements CommandHandler
{

    public function __construct(
        private CategoryRepository $categoryRepository,
        private IdStringGenerator $idStringGenerator)
    {
    }

    public function __invoke(CreateCategoryCommand $command): void
    {

        $category = new Category (
            new CategoryId($this->idStringGenerator->generate()),
            $command->name(),
            null,
            null,
            null
        );


        $this->categoryRepository->insert($category);

    }
}