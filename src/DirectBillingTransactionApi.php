<?php

declare(strict_types=1);

namespace Simpay;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Simpay\Exception\ExceptionFactory;
use Simpay\Model\Request\DirectBillingTransaction;
use Simpay\Model\Request\Filters;
use Simpay\Model\Request\PaymentTransactionId;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Response\DirectBillingTransaction as DirectBillingTransactionResponse;
use Simpay\Model\Response\DirectBillingTransactionCollection;
use Simpay\Model\Response\DirectBillingTransactionCreate;
use Simpay\Model\Response\DirectBillingTransactionList;
use Simpay\Model\Response\Pagination;

class DirectBillingTransactionApi implements DirectBillingTransactionsInterface
{
    private ClientInterface $client;
    public function __construct(HttpClientFactoryInterface $factory)
    {
        $this->client = $factory->create();
    }

    public function directBillingTransactions(
        ServiceId $serviceId,
        ?Filters $filters = null
    ): DirectBillingTransactionCollection {
        try {
            $options = [];
            if (null !== $filters) {
                $options[RequestOptions::QUERY] = $filters->toArray();
            }
            $response = $this->client->request(
                'GET',
                \sprintf('directbilling/%s/transactions', $serviceId),
                $options,
            );
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);
            $transactions = [];

            foreach ($data['data'] as $transaction) {
                $transactions[] = DirectBillingTransactionList::createFromResponse($transaction);
            }

            return new DirectBillingTransactionCollection(
                $transactions,
                Pagination::createFromResponse($data['pagination']),
            );
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function directBillingTransactionCreate(
        ServiceId $serviceId,
        DirectBillingTransaction $request
    ): DirectBillingTransactionCreate {
        try {
            $response = $this->client->request(
                'POST',
                \sprintf('directbilling/%s/transactions', $serviceId),
                [
                    RequestOptions::JSON => $request->toArray(),
                ],
            );
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);

            return DirectBillingTransactionCreate::createFromResponse($data['data']);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }

    public function directBillingTransaction(
        ServiceId $serviceId,
        PaymentTransactionId $transactionId
    ): DirectBillingTransactionResponse {
        try {
            $response = $this->client->request(
                'GET',
                \sprintf('directbilling/%s/transactions/%s', $serviceId, $transactionId),
            );
            $data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);

            return DirectBillingTransactionResponse::createFromResponse($data['data']);
        } catch (RequestException $exception) {
            throw ExceptionFactory::create($exception);
        }
    }
}
