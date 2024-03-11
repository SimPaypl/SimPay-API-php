<?php

declare(strict_types=1);

namespace Simpay;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Simpay\Exception\ExceptionFactory;
use Simpay\Model\Request\Amount;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Response\ServiceCalculation;

class DirectBillingCalculateApi implements DirectBillingCalculateInterface
{
    private ClientInterface $client;

    public function __construct(HttpClientFactoryInterface $factory)
    {
        $this->client = $factory->create();
    }

    public function directBillingServiceCalculate(ServiceId $serviceId, Amount $amount): ServiceCalculation
    {
        try {
            $response = $this->client->request(
                'GET',
                \sprintf('directbilling/%s/calculate', $serviceId),
                [
                    RequestOptions::QUERY => $amount->toArray(),
                ],
            );
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);

            return ServiceCalculation::createFromResponse($data['data']);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }
}
