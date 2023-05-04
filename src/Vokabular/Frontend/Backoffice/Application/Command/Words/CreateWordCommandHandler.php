<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Command\Words;

use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandHandler;
use App\Vokabular\Frontend\Shared\Infrastructure\Service\CurlCommandConnect;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

class CreateWordCommandHandler implements CommandHandler
{

    public function __construct(private CurlCommandConnect $curlCommandConnect)
    {
    }

    public function __invoke(CreateWordCommand $command): void
    {
        try {

           $this->curlCommandConnect->curl('/create/word', [
                'word' => $command->word(),
                'image' => $command->image(),
                'gender' => $command->gender(),
                'level' => $command->level(),
                'category' => $command->category()
            ], 'POST');



        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}