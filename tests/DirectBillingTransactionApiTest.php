<?php

declare(strict_types=1);

namespace Simpay\Test;

use Simpay\DirectBillingTransactionApi;
use Simpay\Model\Request\Amount;
use Simpay\Model\Request\AmountType;
use Simpay\Model\Request\CallbackReturnUrl;
use Simpay\Model\Request\Control;
use Simpay\Model\Request\Description;
use Simpay\Model\Request\DirectBillingTransaction;
use Simpay\Model\Request\DirectBillingTransactionStatus;
use Simpay\Model\Request\Filters;
use Simpay\Model\Request\PaymentTransactionId;
use Simpay\Model\Request\PhoneNumber;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Request\StreamId;
use Simpay\Model\Response\Pagination;

final class DirectBillingTransactionApiTest extends BaseTestCase
{
    /**
     * @test
     */
    public function should_return_direct_billing_transactions(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $this->mockDirectBillingTransactionsApiResponse($serviceId);
        $api = new DirectBillingTransactionApi($this->factory);

        //WHEN
        $response = $api->directBillingTransactions(new ServiceId($serviceId));

        //THEN
        $this->assertSame('dc261d4f-31ef-4728-bfd6-97bbe2a5ef0a', $response->data[0]->id);
        $this->assertSame('transaction_db_payed', $response->data[0]->status);
        $this->assertSame(0.34, $response->data[0]->value);
        $this->assertSame(0.24, $response->data[0]->valueNetto);
        $this->assertSame('test_operator', $response->data[0]->operator);
        $this->assertSame('2023-02-16T14:52:11+01:00', $response->data[0]->createdAt->format(\DateTime::ATOM));
        $this->assertSame('2023-02-16T14:52:11+01:00', $response->data[0]->updatedAt->format(\DateTime::ATOM));

        $this->assertPagination($response->pagination);
    }

    /**
     * @test
     */
    public function should_return_direct_billing_transactions_with_filters(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $this->mockDirectBillingTransactionsWithFiltersApiResponse($serviceId);
        $api = new DirectBillingTransactionApi($this->factory);

        //WHEN
        $response = $api->directBillingTransactions(new ServiceId($serviceId), new Filters(
            DirectBillingTransactionStatus::new(),
            new PhoneNumber('48123456789'),
            new Control('test_control'),
        ));

        //THEN
        $this->assertSame('dc261d4f-31ef-4728-bfd6-97bbe2a5ef0a', $response->data[0]->id);
        $this->assertSame('transaction_db_new', $response->data[0]->status);
        $this->assertSame(0.34, $response->data[0]->value);
        $this->assertSame(0.24, $response->data[0]->valueNetto);
        $this->assertSame('test_operator', $response->data[0]->operator);
        $this->assertSame('2023-02-16T14:52:11+01:00', $response->data[0]->createdAt->format(\DateTime::ATOM));
        $this->assertSame('2023-02-16T14:52:11+01:00', $response->data[0]->updatedAt->format(\DateTime::ATOM));

        $this->assertPagination($response->pagination);
    }

    /**
     * @test
     */
    public function should_create_direct_billing_transaction_only_necessary(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $this->mockDirectBillingTransactionNecessary($serviceId);
        $api = new DirectBillingTransactionApi($this->factory);
        $request = new DirectBillingTransaction(new Amount(5.34));

        //WHEN
        $response = $api->directBillingTransactionCreate(new ServiceId($serviceId), $request);

        //THEN
        $this->assertSame('1d87a1b3-18f8-4146-bcb1-c0c9f293b04f', $response->transactionId);
        $this->assertSame('https://db.simpay.pl/1d87a1b3-18f8-4146-bcb1-c0c9f293b04f', $response->redirectUrl);
    }

    /**
     * @test
     */
    public function should_create_direct_billing_transaction(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $request = new DirectBillingTransaction(
            new Amount(19.99),
            AmountType::createRequired(),
            new Description('test description'),
            new Control('96125f23d5494bfca845b781b5f1ad03'),
            new CallbackReturnUrl('https://www.simpay.pl/success', 'https://www.simpay.pl/failure',),
            new PhoneNumber('48123456789'),
            new StreamId('test_id'),
        );
        $this->mockCreateDirectBillingTransaction($serviceId);
        $api = new DirectBillingTransactionApi($this->factory);

        //WHEN
        $response = $api->directBillingTransactionCreate(new ServiceId($serviceId), $request);

        //THEN
        $this->assertSame('1d87a1b3-18f8-4146-bcb1-c0c9f293b04f', $response->transactionId);
        $this->assertSame('https://db.simpay.pl/1d87a1b3-18f8-4146-bcb1-c0c9f293b04f', $response->redirectUrl);
    }

    /**
     * @test
     */
    public function should_return_direct_billing_transaction(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $transactionId = '1d87a1b3-18f8-4146-bcb1-c0c9f293b04f';
        $this->mockDirectBillingTransactionResponse($serviceId, $transactionId);
        $api = new DirectBillingTransactionApi($this->factory);

        //WHEN
        $response = $api->directBillingTransaction(new ServiceId($serviceId), new PaymentTransactionId($transactionId));

        //THEN
        $this->assertSame($transactionId, $response->id);
        $this->assertSame('transaction_db_payed', $response->status);
        $this->assertNull($response->phoneNumber);
        $this->assertSame('1d87a1b3-18f8-4146-bcb1-c0c9f293b04f', $response->control);
        $this->assertSame(16.67, $response->value);
        $this->assertSame(10.0, $response->valueNetto);
        $this->assertSame('t-mobile', $response->operator->value);
        $this->assertFalse($response->notify->isSend);
        $this->assertSame('2023-02-16T14:52:11+01:00', $response->notify->lastSendAt->format(\DateTime::ATOM));
        $this->assertSame(1, $response->notify->count);
        $this->assertSame('2023-02-16T14:52:11+01:00', $response->createdAt->format(\DateTime::ATOM));
        $this->assertSame('2023-02-16T14:52:11+01:00', $response->updatedAt->format(\DateTime::ATOM));
    }

    private function mockDirectBillingTransactionsApiResponse(string $serviceId): void
    {
        $this->client
            ->expects($this->once())
            ->method('request')
            ->with('GET', \sprintf('directbilling/%s/transactions', $serviceId))
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        [
                            'id' => 'dc261d4f-31ef-4728-bfd6-97bbe2a5ef0a',
                            'status' => 'transaction_db_payed',
                            'value' => 0.34,
                            'value_netto' => 0.24,
                            'operator' => 'test_operator',
                            'created_at' => '2023-02-16T14:52:11+01:00',
                            'updated_at' => '2023-02-16T14:52:11+01:00',
                        ],
                    ],
                    'pagination' => [
                        'total' => 1,
                        'count' => 1,
                        'per_page' => 50,
                        'current_page' => 1,
                        'total_pages' => 1,
                        'links' => [
                            'next_page' => null,
                            'prev_page' => null,
                        ],
                    ],
                ],
            ));
    }

    private function mockDirectBillingTransactionsWithFiltersApiResponse(string $serviceId): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with(
                'GET',
                \sprintf('directbilling/%s/transactions', $serviceId),
                [
                    'query' => [
                        'filter' => [
                            'status' => 'transaction_db_new',
                            'phone_number' => '48123456789',
                            'control' => 'test_control',
                        ],
                    ],
                ],
            )
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        [
                            'id' => 'dc261d4f-31ef-4728-bfd6-97bbe2a5ef0a',
                            'status' => 'transaction_db_new',
                            'value' => 0.34,
                            'value_netto' => 0.24,
                            'operator' => 'test_operator',
                            'created_at' => '2023-02-16T14:52:11+01:00',
                            'updated_at' => '2023-02-16T14:52:11+01:00',
                        ],
                    ],
                    'pagination' => [
                        'total' => 1,
                        'count' => 1,
                        'per_page' => 50,
                        'current_page' => 1,
                        'total_pages' => 1,
                        'links' => [
                            'next_page' => null,
                            'prev_page' => null,
                        ],
                    ],
                ],
            ));
    }

    private function mockDirectBillingTransactionNecessary(string $serviceId): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                \sprintf('directbilling/%s/transactions', $serviceId),
                [
                    'json' => [
                        'amount' => 5.34,
                    ],
                ],
            )
            ->willReturn($this->mockResponse(
                [
                    'success' => true,
                    'data' => [
                        'transaction_id' => '1d87a1b3-18f8-4146-bcb1-c0c9f293b04f',
                        'redirect_url' => 'https://db.simpay.pl/1d87a1b3-18f8-4146-bcb1-c0c9f293b04f',
                    ],
                ],
            ));
    }

    private function mockCreateDirectBillingTransaction(string $serviceId): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                \sprintf('directbilling/%s/transactions', $serviceId),
                [
                    'json' => [
                        'amount' => 19.99,
                        'amount_type' => 'required',
                        'description' => 'test description',
                        'control' => '96125f23d5494bfca845b781b5f1ad03',
                        'phone_number' => '48123456789',
                        'returns' => [
                            'success' => 'https://www.simpay.pl/success',
                            'failure' => 'https://www.simpay.pl/failure',
                        ],
                        'stream_id' => 'test_id',
                    ],
                ],
            )
            ->willReturn($this->mockResponse(
                [
                    'success' => true,
                    'data' => [
                        'transaction_id' => '1d87a1b3-18f8-4146-bcb1-c0c9f293b04f',
                        'redirect_url' => 'https://db.simpay.pl/1d87a1b3-18f8-4146-bcb1-c0c9f293b04f',
                    ],
                ],
            ));
    }

    private function mockDirectBillingTransactionResponse(string $serviceId, string $transactionId): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', \sprintf('directbilling/%s/transactions/%s', $serviceId, $transactionId),)
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        'id' => $transactionId,
                        'status' => 'transaction_db_payed',
                        'phone_number' => null,
                        'control' => '1d87a1b3-18f8-4146-bcb1-c0c9f293b04f',
                        'value' => 16.67,
                        'value_netto' => 10,
                        'operator' => 't-mobile',
                        'notify' => [
                            'is_send' => false,
                            'last_send_at' => '2023-02-16T14:52:11+01:00',
                            'count' => 1,
                        ],
                        'created_at' => '2023-02-16T14:52:11+01:00',
                        'updated_at' => '2023-02-16T14:52:11+01:00',
                    ],
                ],
            ));
    }

    public function assertPagination(Pagination $response): void
    {
        $this->assertSame(1, $response->total);
        $this->assertSame(1, $response->count);
        $this->assertSame(50, $response->perPage);
        $this->assertSame(1, $response->currentPage);
        $this->assertSame(1, $response->totalPages);
        $this->assertNull($response->links->nextPage);
        $this->assertNull($response->links->previousPage);
    }
}
