<?php

declare(strict_types=1);

namespace Simpay\Test;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\Builder\InvocationMocker;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Simpay\HttpClientFactoryInterface;

abstract class BaseTestCase extends TestCase
{
    protected MockObject $client;
    protected MockObject $factory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = $this->createMock(ClientInterface::class);
        $this->factory = $this->createMock(HttpClientFactoryInterface::class);
        $this->factory
            ->method('create')
            ->willReturn($this->client);
    }

    protected function mockResponse(array $response, int $responseCode = 200): Response
    {
        return new Response($responseCode, [], \json_encode($response),);
    }

    protected function mockClientRequest(string $method, string $uri, array $options = []): InvocationMocker
    {
        return $this->client->expects($this->once())
            ->method('request')
            ->with($method, $uri, $options);
    }
}
