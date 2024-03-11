<?php

declare(strict_types=1);

namespace Simpay;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Simpay\Exception\ExceptionFactory;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Request\ServiceNumber;
use Simpay\Model\Request\SmsCode;
use Simpay\Model\Response\Pagination;
use Simpay\Model\Response\SmsService;
use Simpay\Model\Response\SmsServiceCheckCodeData;
use Simpay\Model\Response\SmsServiceCollection;

class SmsServiceApi implements SmsServiceInterface
{
    private ClientInterface $client;
    public function __construct(HttpClientFactoryInterface $factory)
    {
        $this->client = $factory->create();
    }

    public function smsServiceList(): SmsServiceCollection
    {
        try {
            $response = $this->client->request('GET', 'sms');
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);

            $services = [];

            foreach ($data['data'] as $service) {
                $services[] = SmsService::createFromResponse($service);
            }

            return new SmsServiceCollection($services, Pagination::createFromResponse($data['pagination']),);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function smsServiceShow(ServiceId $serviceId): SmsService
    {
        try {
            $response = $this->client->request('GET', \sprintf('sms/%s', $serviceId));
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

            return SmsService::createFromResponse($data['data']);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function smsServiceCheckCode(
        ServiceId $serviceId,
        SmsCode $code,
        ServiceNumber $serviceNumber
    ): SmsServiceCheckCodeData {
        try {
            $response = $this->client->request(
                'POST',
                \sprintf('sms/%s', $serviceId),
                [
                    RequestOptions::JSON => $code->toArray() + $serviceNumber->toArray(),
                ],
            );
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

            return SmsServiceCheckCodeData::createFromResponse($data['data']);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }
}
