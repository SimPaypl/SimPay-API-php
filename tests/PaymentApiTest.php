<?php

declare(strict_types=1);

namespace Simpay\Test;

use Simpay\Model\Request\PaymentTransactionId;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Response\Pagination;
use Simpay\PaymentApi;

final class PaymentApiTest extends BaseTestCase
{
    /**
     * @test
     */
    public function should_return_list_of_payment_services(): void
    {
        //GIVEN
        $this->mockCreatePaymentResponse();
        $api = new PaymentApi($this->factory);

        //WHEN
        $response = $api->paymentGetServices();

        //THEN
        $this->assertSame('d151e4f9', $response->data[0]->id);
        $this->assertSame('Test service', $response->data[0]->name);
        $this->assertSame('service_rejected', $response->data[0]->status->value);
        $this->assertSame('2021-11-08T18:19:16+01:00', $response->data[0]->createdAt->format(\DateTimeInterface::ATOM));

        $this->assertPagination($response->pagination);
    }

    /**
     * @test
     */
    public function should_return_single_payment_service(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $this->mockSinglePaymentServiceResponse($serviceId);
        $api = new PaymentApi($this->factory);

        //WHEN
        $response = $api->paymentGetService(new ServiceId($serviceId));

        //THEN
        $this->assertSame($serviceId, $response->id);
        $this->assertSame('Test service', $response->name);
        $this->assertSame('service_rejected', $response->status->value);
        $this->assertSame('2021-11-08T18:19:16+01:00', $response->createdAt->format(\DateTimeInterface::ATOM));
    }

    /**
     * @test
     */
    public function should_return_service_transactions(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $this->mockPaymentTransactions($serviceId);
        $api = new PaymentApi($this->factory);

        //WHEN
        $response = $api->paymentGetTransactions(new ServiceId($serviceId));

        //THEN
        $this->assertSame($serviceId, $response->data[0]->id);
        $this->assertSame('transaction_paid', $response->data[0]->status->value);
        $this->assertSame(1.0, $response->data[0]->amount);
        $this->assertSame('test', $response->data[0]->control);
        $this->assertSame('test', $response->data[0]->channel);
        $this->assertSame('2021-11-08T18:19:16+01:00', $response->data[0]->paidAt->format(\DateTimeInterface::ATOM));
        $this->assertSame('2021-11-08T18:19:16+01:00', $response->data[0]->createdAt->format(\DateTimeInterface::ATOM));
        $this->assertSame('2021-11-08T18:19:16+01:00', $response->data[0]->updatedAt->format(\DateTimeInterface::ATOM));

        $this->assertPagination($response->pagination);
    }

    /**
     * @test
     */
    public function should_return_channels_list(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $this->mockPaymentChannelsListResponse($serviceId);
        $api = new PaymentApi($this->factory);

        //WHEN
        $response = $api->paymentGetChannels(new ServiceId($serviceId));

        //THEN
        $this->assertSame('d151e4f9', $response->data[0]->id);
        $this->assertSame('Test service', $response->data[0]->name);
        $this->assertSame('test', $response->data[0]->type);
        $this->assertSame('test', $response->data[0]->img);
        $this->assertSame(1.0, $response->data[0]->commission);
        $this->assertSame(['PLN'], $response->data[0]->currencies);
        $this->assertSame(1.0, $response->data[0]->amount->min);
        $this->assertSame(1.0, $response->data[0]->amount->max);

        $this->assertPagination($response->pagination);
    }

    /**
     * @test
     */
    public function should_create_payment_transaction(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $this->mockCreatePaymentTransactionResponse($serviceId);
        $api = new PaymentApi($this->factory);

        //WHEN
        $response = $api->paymentTransactionCreate(new ServiceId($serviceId), PaymentCreateRequestMother::create());

        //THEN
        $this->assertSame('test_transaction_id', $response->transactionId);
        $this->assertSame('https://example.com', $response->redirectUrl);
    }

    /**
     * @test
     */
    public function should_return_single_payment_transaction(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $transactionId = '5a9d5a7e-4c1d-4f5c-8a8d-ebc4a5d6e0e1';
        $this->mockSinglePaymentTransactionResponse($serviceId, $transactionId);
        $api = new PaymentApi($this->factory);

        //WHEN
        $response = $api->paymentGetTransaction(new ServiceId($serviceId), new PaymentTransactionId($transactionId));

        //THEN
        $this->assertSame($transactionId, $response->id);
        $this->assertSame('transaction_paid', $response->status);
        $this->assertSame(19.99, $response->amount->value);
        $this->assertSame('PLN', $response->amount->currency);
        $this->assertSame(0.98, $response->amount->commission);
        $this->assertSame('nest', $response->channel);
        $this->assertSame('test_control', $response->control);
        $this->assertSame('test_description', $response->description);
        $this->assertSame('https://example.com/success', $response->redirects->success);
        $this->assertSame('https://example.com/failure', $response->redirects->failure);
        $this->assertSame('test_name', $response->customer->name);
        $this->assertSame('test_billing_name', $response->billing->name);
        $this->assertSame('test_billing_surname', $response->billing->surname);
        $this->assertSame('test_billing_street', $response->billing->street);
        $this->assertSame('test_billing_building', $response->billing->building);
        $this->assertSame('test_billing_flat', $response->billing->flat);
        $this->assertSame('test_billing_city', $response->billing->city);
        $this->assertSame('test_billing_region', $response->billing->region);
        $this->assertSame('test_billing_postcode', $response->billing->postalCode);
        $this->assertSame('test_billing_country', $response->billing->country);
        $this->assertSame('test_billing_company', $response->billing->company);
        $this->assertSame('test_shipping_name', $response->shipping->name);
        $this->assertSame('test_shipping_surname', $response->shipping->surname);
        $this->assertSame('test_shipping_street', $response->shipping->street);
        $this->assertSame('test_shipping_building', $response->shipping->building);
        $this->assertSame('test_shipping_flat', $response->shipping->flat);
        $this->assertSame('test_shipping_city', $response->shipping->city);
        $this->assertSame('test_shipping_region', $response->shipping->region);
        $this->assertSame('test_shipping_postcode', $response->shipping->postalCode);
        $this->assertSame('test_shipping_country', $response->shipping->country);
        $this->assertSame('test_shipping_company', $response->shipping->company);
        $this->assertSame('test_cart_name', $response->cart[0]->name);
        $this->assertSame(1, $response->cart[0]->quantity);
        $this->assertSame(19.99, $response->cart[0]->price);
        $this->assertSame('test_cart_producer', $response->cart[0]->producer);
        $this->assertSame('test_cart_category', $response->cart[0]->category);
        $this->assertSame('test_cart_code', $response->cart[0]->code);
        $this->assertSame('2023-12-07T05:21:50+01:00', $response->paidAt->format(\DateTimeInterface::ATOM));
        $this->assertSame('2023-12-07T05:21:50+01:00', $response->expiresAt->format(\DateTimeInterface::ATOM));
        $this->assertSame('2023-12-07T05:20:30+01:00', $response->createdAt->format(\DateTimeInterface::ATOM));
        $this->assertSame('2023-12-07T05:21:50+01:00', $response->updatedAt->format(\DateTimeInterface::ATOM));
    }

    private function mockCreatePaymentResponse(): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', 'payment/services')
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        [
                            'id' => 'd151e4f9',
                            'name' => 'Test service',
                            'status' => 'service_rejected',
                            'created_at' => '2021-11-08T18:19:16+01:00',
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

    private function mockSinglePaymentServiceResponse(string $serviceId): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', \sprintf('payment/services/%s', $serviceId),)
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        'id' => $serviceId,
                        'name' => 'Test service',
                        'status' => 'service_rejected',
                        'created_at' => '2021-11-08T18:19:16+01:00',
                    ],
                ],
            ));
    }

    private function mockPaymentTransactions(string $serviceId): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', \sprintf('payment/services/%s/transactions', $serviceId))
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        [
                            'id' => 'd151e4f9',
                            'status' => 'transaction_paid',
                            'amount' => 1.0,
                            'control' => 'test',
                            'channel' => 'test',
                            'paid_at' => '2021-11-08T18:19:16+01:00',
                            'created_at' => '2021-11-08T18:19:16+01:00',
                            'updated_at' => '2021-11-08T18:19:16+01:00',
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

    private function mockPaymentChannelsListResponse(string $serviceId): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', \sprintf('payment/%s/channels', $serviceId),)
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        [
                            'id' => 'd151e4f9',
                            'name' => 'Test service',
                            'type' => 'test',
                            'img' => 'test',
                            'commission' => 1.0,
                            'currencies' => ['PLN'],
                            'amount' => [
                                'min' => 1.0,
                                'max' => 1.0,
                            ],
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

    private function mockCreatePaymentTransactionResponse(string $serviceId): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                \sprintf('payment/%s/transaction', $serviceId),
                [
                    'json' => [
                        'amount' => 23.23,
                        'currency' => 'PLN',
                        'description' => 'Default description',
                        'control' => 'Default control',
                        'customer' => [
                            'name' => 'Default customer',
                            'email' => 'jhondoe@example.com',
                        ],
                        'billing' => [
                            'name' => 'billing name',
                            'surname' => 'billing surname',
                            'street' => 'billing street',
                            'building' => 'billing building',
                            'flat' => 'billing flat',
                            'city' => 'billing city',
                            'region' => 'billing region',
                            'postal_code' => 'billing postcode',
                            'country' => 'billing country',
                            'company' => 'billing company',
                        ],
                        'shipping' => [
                            'name' => 'shipping name',
                            'surname' => 'shipping surname',
                            'street' => 'shipping street',
                            'building' => 'shipping building',
                            'flat' => 'shipping flat',
                            'city' => 'shipping city',
                            'region' => 'shipping region',
                            'postal_code' => 'shipping postcode',
                            'country' => 'shipping country',
                            'company' => 'shipping company',
                        ],
                        'cart' => [
                            [
                                'name' => 'cart item name',
                                'quantity' => 1,
                                'price' => 20.00,
                                'producer' => 'producer',
                                'category' => 'category',
                                'code' => 'code',
                            ],
                        ],
                        'returns' => [
                            'success' => 'https://example.com/success',
                            'failure' => 'https://example.com/failure',
                        ],
                        'direct_channel' => 'direct_channel',
                        'channels' => ['test_channel_id', 'test_channel_id_2'],
                        'channel_types' => [
                            'blik' => true,
                            'transfer' => true,
                            'cards' => true,
                            'ewallets' => true,
                            'paypal' => true,
                        ],
                        'referer' => 'https://example.com',
                    ],
                ],
            )->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        'transaction_id' => 'test_transaction_id',
                        'redirect_url' => 'https://example.com',
                    ],
                ],
            ));
    }

    private function mockSinglePaymentTransactionResponse(string $serviceId, string $transactionId): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', \sprintf('payment/%s/transaction/%s', $serviceId, $transactionId))
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        'id' => '5a9d5a7e-4c1d-4f5c-8a8d-ebc4a5d6e0e1',
                        'status' => 'transaction_paid',
                        'amount' => [
                            'value' => 19.99,
                            'currency' => 'PLN',
                            'commission' => 0.98,
                        ],
                        'channel' => 'nest',
                        'control' => 'test_control',
                        'description' => 'test_description',
                        'redirects' => [
                            'success' => 'https://example.com/success',
                            'failure' => 'https://example.com/failure',
                        ],
                        'customer' => [
                            'name' => 'test_name',
                            'email' => 'kontakt@simpay.pl',
                        ],
                        'billing' => [
                            'name' => 'test_billing_name',
                            'surname' => 'test_billing_surname',
                            'street' => 'test_billing_street',
                            'building' => 'test_billing_building',
                            'flat' => 'test_billing_flat',
                            'city' => 'test_billing_city',
                            'region' => 'test_billing_region',
                            'postalCode' => 'test_billing_postcode',
                            'country' => 'test_billing_country',
                            'company' => 'test_billing_company',
                        ],
                        'shipping' => [
                            'name' => 'test_shipping_name',
                            'surname' => 'test_shipping_surname',
                            'street' => 'test_shipping_street',
                            'building' => 'test_shipping_building',
                            'flat' => 'test_shipping_flat',
                            'city' => 'test_shipping_city',
                            'region' => 'test_shipping_region',
                            'postalCode' => 'test_shipping_postcode',
                            'country' => 'test_shipping_country',
                            'company' => 'test_shipping_company',
                        ],
                        'cart' => [
                            [
                                'name' => 'test_cart_name',
                                'quantity' => 1,
                                'price' => 19.99,
                                'producer' => 'test_cart_producer',
                                'category' => 'test_cart_category',
                                'code' => 'test_cart_code',
                            ],
                        ],
                        'paid_at' => '2023-12-07T05:21:50+01:00',
                        'expires_at' => '2023-12-07T05:21:50+01:00',
                        'created_at' => '023-12-07T05:20:30+01:00',
                        'updated_at' => '2023-12-07T05:21:50+01:00',
                    ],
                ],
            ));
    }

    private function assertPagination(Pagination $pagination): void
    {
        $this->assertSame(1, $pagination->total);
        $this->assertSame(1, $pagination->count);
        $this->assertSame(50, $pagination->perPage);
        $this->assertSame(1, $pagination->currentPage);
        $this->assertSame(1, $pagination->totalPages);
        $this->assertNull($pagination->links->nextPage);
        $this->assertNull($pagination->links->previousPage);
    }
}
