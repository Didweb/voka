<?php

namespace App\Vokabular\Api\Application\Command\Words;

use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Gender;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\Level;
use App\Vokabular\Api\Domain\Model\Words\ValueObjects\WordId;
use App\Vokabular\Api\Domain\Model\Words\Word;
use App\Vokabular\Api\Domain\Model\Words\WordRepository;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandHandler;

class ChangeImageWordCommandHandler implements CommandHandler
{

    public function __construct(private WordRepository $wordRepository)
    {
    }
    public function __invoke(ChangeImageWordCommand $command)
    {
        $word = new Word(
            WordId::create($command->id()),
            '',
            $command->image(),
            new Gender('der'),
            new Level('C1'),
            null,
            null,
            null
        );
        $this->wordRepository->updateImage($word);
    }
}