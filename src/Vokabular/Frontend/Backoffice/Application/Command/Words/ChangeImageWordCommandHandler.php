<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Command\Words;

use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandHandler;
use App\Vokabular\Frontend\Shared\Infrastructure\Service\CurlCommandConnect;
use Exception;

class ChangeImageWordCommandHandler implements CommandHandler
{

    public function __construct(private CurlCommandConnect $curlCommandConnect)
    {
    }

    public function __invoke(ChangeImageWordCommand $command)
    {
        try {
            $this->curlCommandConnect->curl('/change-image/word',[
                'id' => $command->id(),
                'image' => $command->image()
            ], 'PUT');

        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}