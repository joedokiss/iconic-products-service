<?php
namespace App\Services;

use GuzzleHttp\Client;

class HttpService
{
    const HEADERS = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ];

    private $client;
    private $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->client = app()->make(Client::class, ['config' => ['headers' => self::HEADERS]]);
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
        $request = $this->client->request($method, $this->baseUrl . $path, $queryParams);

        return json_decode($request->getBody()->getContents(), true);
    }
}
