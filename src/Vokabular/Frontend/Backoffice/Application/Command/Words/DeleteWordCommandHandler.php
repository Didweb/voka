<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Command\Words;

use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandHandler;
use App\Vokabular\Frontend\Shared\Infrastructure\Service\CurlCommandConnect;
use Exception;

class DeleteWordCommandHandler implements CommandHandler
{

    public function __construct(
        private CurlCommandConnect $curlCommandConnect,
        private string $pathPublicImages)
    {
    }

    public function __invoke(DeleteWordCommand $deleteWordCommand): void
    {
        try {

            unlink($this->pathPublicImages.$deleteWordCommand->image());

            $this->curlCommandConnect->curl('/delete/word',[
                'id' => $deleteWordCommand->id()
            ], 'DELETE');

        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}