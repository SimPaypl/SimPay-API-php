<?php

declare(strict_types=1);

namespace Simpay;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Simpay\Exception\ExceptionFactory;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Response\Pagination;
use Simpay\Model\Response\Service;
use Simpay\Model\Response\ServiceCollection;

class DirectBillingApi implements DirectBillingInterface
{
    private ClientInterface $client;

    public function __construct(HttpClientFactoryInterface $factory)
    {
        $this->client = $factory->create();
    }

    public function directBillingGetServices(): ServiceCollection
    {
        try {
            $response = $this->client->request('GET', 'directbilling',);
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);
            $services = [];

            foreach ($data['data'] as $service) {
                $services[] = Service::createFromResponse($service);
            }

            return new ServiceCollection($services, Pagination::createFromResponse($data['pagination']));
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function directBillingService(ServiceId $serviceId): Service
    {
        try {
            $response = $this->client->request('GET', \sprintf('directbilling/%s', $serviceId),);
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);

            return Service::createFromResponse($data['data']);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }
}
