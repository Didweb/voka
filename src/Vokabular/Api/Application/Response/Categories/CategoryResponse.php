<?php

namespace App\Vokabular\Api\Application\Response\Categories;

use App\Vokabular\Api\Domain\Model\Categories\Category;

class CategoryResponse
{
    private string $id;
    private string $name;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    public function __construct(Category $category)
    {
        $this->id = $category->id()->value();
        $this->name = $category->name();
        $this->createdAt = $category->createdAt();
        $this->updatedAt = $category->updatedAt();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function createdAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function updatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'createdAt' => $this->createdAt(),
            'updatedAt' => $this->updatedAt()
            ];
    }
}