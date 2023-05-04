<?php

namespace App\Vokabular\Api\Application\Command\Words;

use App\Vokabular\Api\Domain\Model\Categories\Category;
use App\Vokabular\Api\Domain\Model\Categories\ValuesObject\CategoryId;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Gender;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Level;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\WordId;
use App\Vokabular\Api\Domain\Model\Words\Word;
use App\Vokabular\Api\Domain\Model\Words\WordRepository;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandHandler;

class EditWordCommandHandler implements CommandHandler
{

    public function __construct(private WordRepository $wordRepository)
    {
    }

    public function __invoke(EditWordCommand $command)
    {
        $categoryJson = json_decode($command->category());

        $category = new Category(
            CategoryId::create($categoryJson->id),
            $categoryJson->name,
            new \DateTime($categoryJson->createdAt->date),
            new \DateTime($categoryJson->updatedAt->date),
            null
        );

        $word = new Word(
            new WordId($command->id()),
            $command->word(),
            '',
            new Gender($command->gender()),
            new Level($command->level()),
            null,
            null,
            $category,
        );

        $this->wordRepository->updateWordComplete($word);
    }
}