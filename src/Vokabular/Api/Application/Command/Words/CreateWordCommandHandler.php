<?php

namespace App\Vokabular\Api\Application\Command\Words;

use App\Vokabular\Api\Domain\Model\Categories\Category;
use App\Vokabular\Api\Domain\Model\Categories\ValuesObject\CategoryId;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Gender;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Level;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\WordId;
use App\Vokabular\Api\Domain\Model\Words\Word;
use App\Vokabular\Api\Domain\Model\Words\WordRepository;
use App\Vokabular\Api\Domain\Service\IdStringGenerator;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandHandler;

class CreateWordCommandHandler implements CommandHandler
{

    public function __construct(
        private WordRepository $wordRepository,
        private IdStringGenerator $idStringGenerator,
    )
    {
    }

    public function __invoke(CreateWordCommand $command)
    {
        $categoryJson = json_decode($command->category());

        $category = new Category(
                CategoryId::create($categoryJson->id),
                $categoryJson->name,
                new \DateTime($categoryJson->createdAt->date),
                new \DateTime($categoryJson->updatedAt->date),
            null
            );


        $word =  new Word(
            new WordId($this->idStringGenerator->generate()),
            $command->word(),
            $command->image(),
            new Gender($command->gender()),
            new Level($command->level()),
            null,
            null,
            $category
        );

        $this->wordRepository->insert($word);
        $this->wordRepository->updateWord($word);
    }
}