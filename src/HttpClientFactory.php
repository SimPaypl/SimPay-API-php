<?php

declare(strict_types=1);

namespace Simpay;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;

class HttpClientFactory implements HttpClientFactoryInterface
{
    private Configuration $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }
    public function create(): ClientInterface
    {
        return new Client(
            [
                'base_uri' => Configuration::API_BASE_URI,
                RequestOptions::HEADERS => $this->configuration->getAuthHeader(),
            ],
        );
    }
}
