<?php

namespace App\Vokabular\Frontend\Shared\Infrastructure\Service;

use Symfony\Component\HttpClient\HttpClient;

class CurlCommandConnect
{

    public function __construct(private string $pathToApi)
    {
    }

    public function curl(string $url, array $data, $method = 'POST'): array
    {

        try {
            $httpClient =  HttpClient::create();
            $response = $httpClient->request(
                $method,
                $this->pathToApi.$url,
                [
                    'body'=> $data
                ]
            );

        return $response->toArray();

        } catch (\Exception $e){

            throw new \Exception($e->getMessage());
        }

    }

}