<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Command\Categories;

use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandHandler;
use App\Vokabular\Frontend\Shared\Infrastructure\Service\CurlCommandConnect;

class CreateCategoryCommandHandler implements CommandHandler
{

    public function __construct(private CurlCommandConnect $curlCommandConnect)
    {
    }

    public function __invoke(CreateCategoryCommand $command): void
    {

        $this->curlCommandConnect->curl('/create/category', [
            'name' => $command->name()
        ]);

    }
}