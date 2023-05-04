<?php

namespace App\Vokabular\Frontend\Backoffice\Application\Command\Categories;

use App\Vokabular\Frontend\Shared\Domain\Bus\Command\CommandHandler;
use App\Vokabular\Frontend\Shared\Infrastructure\Service\CurlCommandConnect;
use Exception;

class DeleteCategoryCommandHandler implements CommandHandler
{

    public function __construct(private CurlCommandConnect $curlCommandConnect)
    {
    }

    public function __invoke(DeleteCategoryCommand $deleteCategoryCommand): void
    {

        try {
            $this->curlCommandConnect->curl('/delete/category', [
                'id' => $deleteCategoryCommand->id()
            ], 'DELETE');

        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }

    }
}