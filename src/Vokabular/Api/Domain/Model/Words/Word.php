<?php

namespace App\Vokabular\Api\Domain\Model\Words;

use App\Vokabular\Api\Domain\Model\Categories\Category;
use App\Vokabular\Api\Domain\Model\Categories\ValuesObject\CategoryId;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Gender;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Level;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\WordId;

class Word
{
    public function __construct(
        private WordId $id,
        private string $word,
        private string $image,
        private Gender $gender,
        private Level $level,
        private ?\DateTime $createdAt,
        private ?\DateTime $updatedAt,
        private ?Category $category
    )
    {
        $this->createdAt = ($createdAt === null)?new \DateTime():$createdAt;
        $this->updatedAt = ($updatedAt === null)?new \DateTime():$updatedAt;
    }

    public function id(): WordId
    {
        return $this->id;
    }

    public function word(): string
    {
        return $this->word;
    }

    public function image(): string
    {
        return $this->image;
    }

    public function gender(): Gender
    {
        return $this->gender;
    }

    public function level(): Level
    {
        return $this->level;
    }

    public function createdAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function category(): ?Category
    {
        return $this->category;
    }

    public static function fromInfrastructure(object $word): self
    {
        return new Word(
            WordId::create($word->id()),
            $word->word(),
            $word->image(),
            new Gender($word->gender()),
            new Level($word->level()),
            $word->createdAt(),
            $word->updatedAt(),
            $word->category()
        );
    }

    public static function fromInfrastructureStdObject(object $word): self
    {

        $category =  null;
         if($word->category == null && $word->category != '') {
             $category = Category::fromObject($word->category);
         }

        return new Word(
            WordId::create($word->id),
            $word->word,
            $word->image,
            new Gender($word->gender),
            new Level($word->level),
            new \DateTime($word->category->createdAt->date),
            new \DateTime($word->category->updatedAt->date),
            $category
        );
    }

    public static function fromArray(array $array): self
    {
        $createdAt = (is_array($array['createdAt']))?$array['createdAt']['date']:$array['createdAt'];
        $updatedAt = (is_array($array['updatedAt']))?$array['updatedAt']['date']:$array['updatedAt'];

        return new Word(
            WordId::create($array['id']),
            $array['word'],
            $array['image'],
            new Gender($array['gender']),
            new Level($array['level']),
            new \DateTime($createdAt),
            new \DateTime($updatedAt),
            Category::fromArray($array['category'])
        );
    }

    public static function toArray(Word $word): array
    {
        return [
            'id' => $word->id()->value(),
            'word' => $word->word(),
            'image' => $word->image(),
            'gender' => $word->gender()->__toString(),
            'level' => $word->level()->__toString(),
            'createdAt' => $word->createdAt()->format('Y-m-d H:i:s'),
            'updatedAt' => $word->updatedAt()->format('Y-m-d H:i:s'),
            'category' => $word->category()->toArray(),
        ];
    }

    public  function __toArray(): array
    {
        return [
            'id' => $this->id()->value(),
            'word' => $this->word(),
            'image' => $this->image(),
            'gender' => $this->gender()->__toString(),
            'level' => $this->level()->__toString(),
            'createdAt' => $this->createdAt(),
            'updatedAt' => $this->updatedAt(),
            'category' => $this->category()->toArray(),
        ];
    }


}