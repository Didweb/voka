<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Command\Words;

use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandHandler;
use App\Vokabular\Frontend\Shared\Infrastructure\Service\CurlCommandConnect;
use Exception;

class EditWordCommandHandler implements CommandHandler
{

    public function __construct(private CurlCommandConnect $curlCommandConnect)
    {
    }

    public function __invoke(EditWordCommand $command)
    {
        try {
           $this->curlCommandConnect->curl('/edit/word', [
                'id' => $command->id(),
                'word' => $command->word(),
                'gender' => $command->gender(),
                'level' => $command->level(),
                'category' => $command->category()
            ], 'PUT');


        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}