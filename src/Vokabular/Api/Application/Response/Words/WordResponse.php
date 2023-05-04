<?php

namespace App\Vokabular\Api\Application\Response\Words;

use App\Vokabular\Api\Domain\Model\Categories\Category;
use App\Vokabular\Api\Domain\Model\Words\Word;
use App\Vokabular\Api\Shared\Domain\Bus\Query\Response;

class WordResponse  implements Response
{
    private string $id;
    private string $word;
    private string $image;
    private string $gender;
    private string $level;
    private ?\DateTime $createdAt;
    private ?\DateTime $updatedAt;
    private ?array $category;

    public function __construct(Word $word)
    {
        $this->id = $word->id()->value();
        $this->word = $word->word();
        $this->image = $word->image();
        $this->gender = $word->gender();
        $this->level = $word->level();
        $this->createdAt = $word->createdAt();
        $this->updatedAt = $word->updatedAt();
        $this->category = ($word->category() !== null)?$word->category()->toArray():null;
    }

    public function id(): string
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

    public function gender(): string
    {
        return $this->gender;
    }

    public function level(): string
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

    public function category(): ?array
    {
        return $this->category;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'word' => $this->word(),
            'image' => $this->image(),
            'gender' => $this->gender(),
            'level' => $this->level(),
            'createdAt' => $this->createdAt(),
            'updatedAt' => $this->updatedAt(),
            'category' => $this->category()
        ];

    }

}