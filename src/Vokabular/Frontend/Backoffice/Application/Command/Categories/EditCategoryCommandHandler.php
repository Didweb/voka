<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Command\Categories;

use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandHandler;
use App\Vokabular\Frontend\Shared\Infrastructure\Service\CurlCommandConnect;
use Exception;

class EditCategoryCommandHandler implements CommandHandler
{

    public function __construct(private CurlCommandConnect $curlCommandConnect)
    {
    }

    public function __invoke(EditCategoryCommand $command)
    {
        try {
            $this->curlCommandConnect->curl('/edit/category', [
                'id' => $command->id(),
                'name' => $command->name(),
                'createdAt' => $command->createAt()
            ], 'PUT');

        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}