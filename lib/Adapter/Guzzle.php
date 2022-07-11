<?php

namespace SimPay\API\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use SimPay\API\Authorization;

class Guzzle
{

    private Client $client;

    private string $error;
    private string $errorCode;

    private string $errorApi;

    private object $data;

    public function __construct(Authorization $authorization)
    {
        $this->client = new Client([
            'base_uri' => 'https://api.simpay.pl',
            'headers' => $authorization->getHeaders()
        ]);
    }

    public function request(string $method, string $uri, array $data = [], array $headers = [], bool $collect = false)
    {

        try {

            $response = $this->client->request($method, $uri, [
                ($method === 'GET' ? 'query' : 'json') => $data,
                'headers' => $headers,
                'allow_redirects' => false
            ]);

            $response = $response->getBody()->getContents();
            $response = json_decode($response);

            $this->data = $response;

        } catch (ClientException $exception) {

            $response = $exception->getResponse()->getBody()->getContents();
            $json = json_decode($response);

            if (isset($json->message)) {
                $this->errorApi = $json->message;
            }

            $this->error = $exception->getMessage();
            $this->errorCode = $exception->getCode();

            return false;

        } catch (GuzzleException $exception) {

            $this->error = $exception->getMessage();
            $this->errorCode = $exception->getCode();

            return false;

        }

        return !$collect ? $response->data : new Collection($response->data);

    }

    public function getErrorMessage(): string
    {
        return $this->error;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    public function getErrorApiMessage(): string
    {
        return $this->errorApi;
    }

    public function getPagination()
    {
        return $this->data->pagination;
    }

}