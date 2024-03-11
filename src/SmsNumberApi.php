<?php

declare(strict_types=1);

namespace Simpay;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Simpay\Exception\ExceptionFactory;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Response\Pagination;
use Simpay\Model\Response\SmsNumber;
use Simpay\Model\Response\SmsNumberCollection;

class SmsNumberApi implements SmsNumbersInterface
{
    private ClientInterface $client;
    public function __construct(HttpClientFactoryInterface $factory)
    {
        $this->client = $factory->create();
    }

    public function smsServiceNumbersList(ServiceId $serviceId): SmsNumberCollection
    {
        try {
            $response = $this->client->request('GET', \sprintf('sms/%s/numbers', $serviceId),);
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

            $smsNumbers = [];

            foreach ($data['data'] as $smsNumber) {
                $smsNumbers[] = SmsNumber::createFromResponse($smsNumber);
            }

            return new SmsNumberCollection($smsNumbers, Pagination::createFromResponse($data['pagination']));
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function smsServiceNumber(ServiceId $serviceId, Model\Request\SmsNumber $number): Model\Response\SmsNumber
    {
        try {
            $response = $this->client->request('GET', \sprintf('sms/%s/numbers/%s', $serviceId, $number),);
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

            return SmsNumber::createFromResponse($data['data']);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function smsNumbers(): SmsNumberCollection
    {
        try {
            $response = $this->client->request('GET', 'sms/numbers');
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

            $smsNumbers = [];

            foreach ($data['data'] as $smsNumber) {
                $smsNumbers[] = SmsNumber::createFromResponse($smsNumber);
            }

            return new SmsNumberCollection($smsNumbers, Pagination::createFromResponse($data['pagination']));
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function smsNumber(Model\Request\SmsNumber $number): Model\Response\SmsNumber
    {
        try {
            $response = $this->client->request('GET', \sprintf('sms/numbers/%s', $number));
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

            return SmsNumber::createFromResponse($data['data']);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }
}
