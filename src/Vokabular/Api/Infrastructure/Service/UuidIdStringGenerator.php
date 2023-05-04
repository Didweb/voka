<?php

namespace App\Vokabular\Api\Infrastructure\Service;

use App\Vokabular\Api\Domain\Service\IdStringGenerator;
use Ramsey\Uuid\Uuid;

class UuidIdStringGenerator implements IdStringGenerator
{

    public function generate(): string
    {
        return Uuid::uuid4();
    }
}