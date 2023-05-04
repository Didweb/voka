<?php

namespace App\Vokabular\Frontend\Shared\Infrastructure\Service;

use Symfony\Component\HttpClient\HttpClient;

class CurlQueryConnect
{

    public function __construct(private string $pathToApi)
    {
    }

    public function curl(string $url, $method = 'GET'): array
    {

        $httpClient =  HttpClient::create();
        $response = $httpClient->request(
                $method,
            $this->pathToApi.$url
        );

        return $response->toArray();
    }
}