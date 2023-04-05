<?php

namespace Movies\QSS\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class QssApiClient
{
    private $baseUri;
    private $email;
    private $password;
    private $httpClient;

    public function __construct(string $baseUri, string $email, string $password)
    {
        $this->baseUri = $baseUri;
        $this->email = $email;
        $this->password = $password;

        $this->httpClient = new Client([
            'base_uri' => $this->baseUri,
            'timeout' => 5.0,
        ]);
    }

    public function authenticate()
    {
        try {
            $response = $this->httpClient->post('/api/login_check', [
                'json' => [
                    'email' => $this->email,
                    'password' => $this->password,
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            return $data['token'];
        } catch (RequestException $e) {
            throw new \Exception('Failed to authenticate with QSS API');
        }
    }

    public function get(string $endpoint, array $headers = [])
    {
        try {
            $response = $this->httpClient->get($endpoint, [
                'headers' => $headers,
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            throw new \Exception('Failed to get data from QSS API');
        }
    }

    public function post(string $endpoint, array $data, array $headers = [])
    {
        try {
            $response = $this->httpClient->post($endpoint, [
                'json' => $data,
                'headers' => $headers,
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            throw new \Exception('Failed to post data to QSS API');
        }
    }
}