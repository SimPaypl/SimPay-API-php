<?php

declare(strict_types=1);

namespace Simpay;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Simpay\Exception\ExceptionFactory;
use Simpay\Model\Request\CreatePayment;
use Simpay\Model\Request\PaymentTransactionId;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Response\Pagination;
use Simpay\Model\Response\PaymentChannel;
use Simpay\Model\Response\PaymentChannelCollection;
use Simpay\Model\Response\PaymentCreate;
use Simpay\Model\Response\PaymentService;
use Simpay\Model\Response\PaymentServiceCollection;
use Simpay\Model\Response\PaymentServiceTransaction;
use Simpay\Model\Response\PaymentServiceTransactionCollection;
use Simpay\Model\Response\PaymentTransaction;

class PaymentApi implements PaymentInterface
{
    private ClientInterface $client;
    public function __construct(HttpClientFactoryInterface $factory)
    {
        $this->client = $factory->create();
    }

    public function paymentGetServices(): PaymentServiceCollection
    {
        try {
            $response = $this->client->request('GET', 'payment/services',);
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);

            $services = [];

            foreach ($data['data'] as $service) {
                $services[] = PaymentService::createFromResponse($service);
            }

            return new PaymentServiceCollection($services, Pagination::createFromResponse($data['pagination']),);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function paymentGetService(ServiceId $serviceId): PaymentService
    {
        try {
            $response = $this->client->request('GET', \sprintf('payment/services/%s', $serviceId),);
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);

            return PaymentService::createFromResponse($data['data']);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function paymentGetTransactions(ServiceId $serviceId): PaymentServiceTransactionCollection
    {
        try {
            $response = $this->client->request('GET', \sprintf('payment/services/%s/transactions', $serviceId),);
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);

            $transactions = [];

            foreach ($data['data'] as $transaction) {
                $transactions[] = PaymentServiceTransaction::createFromResponse($transaction);
            }

            return new PaymentServiceTransactionCollection(
                $transactions,
                Pagination::createFromResponse($data['pagination']),
            );
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function paymentGetChannels(ServiceId $serviceId): PaymentChannelCollection
    {
        try {
            $response = $this->client->request('GET', \sprintf('payment/%s/channels', $serviceId),);
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);

            $channels = [];

            foreach ($data['data'] as $channel) {
                $channels[] = PaymentChannel::createFromResponse($channel);
            }

            return new PaymentChannelCollection($channels, Pagination::createFromResponse($data['pagination']),);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function paymentTransactionCreate(ServiceId $serviceId, CreatePayment $request): PaymentCreate
    {
        try {
            $response = $this->client->request(
                'POST',
                \sprintf('payment/%s/transaction', $serviceId),
                [
                    RequestOptions::JSON => $request->toArray(),
                ],
            );
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);

            return PaymentCreate::createFromResponse($data['data']);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function paymentGetTransaction(ServiceId $serviceId, PaymentTransactionId $transactionId): PaymentTransaction
    {
        try {
            $response = $this->client->request(
                'GET',
                \sprintf('payment/%s/transaction/%s', $serviceId, $transactionId),
            );
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);

            return PaymentTransaction::createFromResponse($data['data']);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }
}
