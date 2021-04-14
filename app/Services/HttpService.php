<?php
namespace App\Services;

class HttpService
{
    private $client;
    private $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Make a request to get the data through API
     * @param string $method
     * @param string $path
     * @param array $queryParams
     * @return array
     */
    public function getData(string $method, string $path, array $queryParams = []): array
    {

    }
}
