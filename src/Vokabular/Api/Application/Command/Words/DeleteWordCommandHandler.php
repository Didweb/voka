<?php

namespace App\Vokabular\Api\Application\Command\Words;

use App\Vokabular\Api\Domain\Model\Words\WordRepository;
use App\Vokabular\Api\Shared\Domain\Bus\Command\CommandHandler;

class DeleteWordCommandHandler implements CommandHandler
{

    public function __construct(private WordRepository $wordRepository)
    {
    }

    public function __invoke(DeleteWordCommand $deleteWordCommand)
    {
        $this->wordRepository->delete($deleteWordCommand->id());
    }
}