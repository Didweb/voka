<?php

namespace App\Vokabular\Api\Domain\Model\Categories;

use App\Vokabular\Api\Domain\Model\Categories\ValuesObject\CategoryId;
use App\Vokabular\Api\Domain\Model\Words\WordsCollection;
use Doctrine\Common\Collections\Collection;


class Category
{
    private CategoryId $id;
    private string $name;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;
    private ?Collection $words;



    public function __construct(
        CategoryId $id,
        string $name,
        ?\DateTime $createdAt,
        ?\DateTime $updatedAt,
        ?Collection $words

    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = ($createdAt === null)?new \DateTime():$createdAt;
        $this->updatedAt = ($updatedAt === null)?new \DateTime():$updatedAt;
        $this->words = $words;

    }


    public function id(): CategoryId
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

    public function words(): ?Collection
    {
        return $this->words;
    }


    public static function fromInfrastructure(object $category): self
    {
        return new Category(
             CategoryId::create($category->id()),
             $category->name(),
             $category->createdAt(),
             $category->updatedAt(),
             $category->words()
        );
    }

    public static function fromObject(object $category): self
    {

        return new Category(
            CategoryId::create($category->id),
            $category->name,
            new \DateTime($category->createdAt->date),
            new \DateTime($category->updatedAt->date),
            null
        );
    }


    public function toArray(): array
    {
        $createdAt = (array)$this->createdAt();
        $updatedAt = (array)$this->updatedAt();

        return [
            'id' => $this->id()->value(),
            'name' => $this->name(),
            'createdAt' => $createdAt['date'],
            'updatedAt' => $updatedAt['date']
        ];
    }

    public function encode(): string
    {
        $category = [
            'id' => $this->id()->value(),
            'name' => $this->name(),
            'createdAt' => $this->createdAt(),
            'updatedAt' => $this->updatedAt(),
            'words' => $this->words(),
        ];
        return json_encode($category, true);
    }

    public function decode(string $category): string
    {
        return json_encode($category);
    }

    public static function fromArray(?array $array): ?self
    {

        $category =  null;

        $createdAt = $array['createdAt'];
        if(is_array($createdAt)) {
            $createdAt = $array['createdAt']['date'];
        }

        $updatedAt = $array['updatedAt'];
        if(is_array($updatedAt)) {
            $updatedAt = $array['updatedAt']['date'];
        }

        if($array != null) {
            $category = new Category(
                CategoryId::create($array['id']),
                $array['name'],
                new \DateTime($createdAt),
                new \DateTime($updatedAt),
                null
            );
        }

        return $category;
    }

    public function getArrayIds()
    {
        return 'xxx';
    }
}