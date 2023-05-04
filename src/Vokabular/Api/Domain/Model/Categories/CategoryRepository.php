<?php

namespace App\Vokabular\Api\Domain\Model\Categories;

use App\Vokabular\Api\Application\Command\Categories\EditCategoryCommand;
use App\Vokabular\Api\Application\Response\Categories\CategoryCollectionResponse;

interface CategoryRepository
{
    public function insert(Category $category): void;
    public function update(EditCategoryCommand $category): void;
    public function delete(string $id): void;

    public function findByName(string $name): CategoryCollectionResponse;
    public function findAll(): CategoryCollectionResponse;
}