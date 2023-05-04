<?php

namespace App\Vokabular\Api\Infrastructure\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

class APIResponse extends JsonResponse
{


    public function __construct(string $message,
                                $data = null,
                                array $errors = [],
                                int $status = 200,
                                array $headers = [],
                                bool $json = false)
    {
        parent::__construct([
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
        ], $status, $headers, $json);
    }
}