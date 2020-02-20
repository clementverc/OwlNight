<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class ApiService {
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:3000',
        ]);
    }

    public function makeGet(string $path)
    {
        return $this->client->get($path, [
            'headers' => $this->addHeaders(),
        ]);
    }

    public function makePost(string $path, ?array $body = [])
    {
        return $this->client->post($path, [
            'headers' => $this->addHeaders(),
            RequestOptions::JSON => $body,
        ]);
    }

    private function addHeaders()
    {
        $token = null;
        return [
            'content-type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];
    }
}
