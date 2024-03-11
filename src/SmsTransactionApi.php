<?php

declare(strict_types=1);

namespace Simpay;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Simpay\Exception\ExceptionFactory;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Request\SmsTransactionId;
use Simpay\Model\Response\Pagination;
use Simpay\Model\Response\SmsTransaction;
use Simpay\Model\Response\SmsTransactionCollection;

class SmsTransactionApi implements SmsTransactionInterface
{
    private ClientInterface $client;
    public function __construct(HttpClientFactoryInterface $factory)
    {
        $this->client = $factory->create();
    }

    public function smsTransactionsList(ServiceId $serviceId): SmsTransactionCollection
    {
        try {
            $response = $this->client->request('GET', \sprintf('sms/%s/transactions', $serviceId),);
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);
            $transactions = [];

            foreach ($data['data'] as $transaction) {
                $transactions[] = SmsTransaction::createFromResponse($transaction);
            }

            return new SmsTransactionCollection($transactions, Pagination::createFromResponse($data['pagination']), );
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function smsTransactionsShow(ServiceId $serviceId, SmsTransactionId $transactionId): SmsTransaction
    {
        try {
            $response = $this->client->request(
                'GET',
                \sprintf('sms/%s/transactions/%s', $serviceId, $transactionId),
            );
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);

            return SmsTransaction::createFromResponse($data['data']);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }
}
