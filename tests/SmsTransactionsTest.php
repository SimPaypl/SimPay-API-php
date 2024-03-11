<?php

declare(strict_types=1);

namespace Simpay\Test;

use Simpay\Model\Request\ServiceId;
use Simpay\Model\Request\ServiceNumber;
use Simpay\Model\Request\SmsTransactionId;
use Simpay\Model\Response\Pagination;
use Simpay\SmsTransactionApi;

final class SmsTransactionsTest extends BaseTestCase
{
    /**
     * @test
     */
    public function should_return_sms_transactions_list(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $phoneNumber = 48_123_123_123;
        $smsCode = '123456';
        $serviceNumber = ServiceNumber::SERVICE_NUMBER_7055;

        $this->mockSmsTransactionsListResponse($serviceId, $phoneNumber, $smsCode, $serviceNumber);
        $smsApi = new SmsTransactionApi($this->factory);

        //WHEN
        $response = $smsApi->smsTransactionsList(new ServiceId($serviceId));

        //THEN
        $this->assertSame(1, $response->data[0]->id);
        $this->assertSame($phoneNumber, $response->data[0]->from);
        $this->assertSame($smsCode, $response->data[0]->code);
        $this->assertFalse($response->data[0]->used);
        $this->assertSame($serviceNumber, $response->data[0]->sendNumber->value);

        $this->assertPagination($response->pagination);
    }

    /**
     * @test
     */
    public function should_return_sms_transaction(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $transactionId = 1;
        $phoneNumber = 48_123_123_123;
        $smsCode = '123456';
        $serviceNumber = ServiceNumber::SERVICE_NUMBER_7155;

        $this->mockSmsTransactionResponse($serviceId, $transactionId, $phoneNumber, $smsCode, $serviceNumber);
        $smsApi = new SmsTransactionApi($this->factory);

        //WHEN
        $response = $smsApi->smsTransactionsShow(new ServiceId($serviceId), new SmsTransactionId($transactionId));
        //THEN
        $this->assertSame($transactionId, $response->id);
        $this->assertSame($phoneNumber, $response->from);
        $this->assertSame($smsCode, $response->code);
        $this->assertFalse($response->used);
        $this->assertSame($serviceNumber, $response->sendNumber->value);
        $this->assertSame(0.25, $response->value);
        $this->assertSame('2021-01-01 00:00:00', $response->sendAt->format('Y-m-d H:i:s'));
    }

    private function mockSmsTransactionsListResponse(
        string $serviceId,
        int $phoneNumber,
        string $smsCode,
        int $serviceNumber
    ): void {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', \sprintf('sms/%s/transactions', $serviceId))
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        [
                            'id' => 1,
                            'from' => $phoneNumber,
                            'code' => $smsCode,
                            'used' => false,
                            'send_number' => $serviceNumber,
                            'value' => 0.25,
                            'send_at' => '2021-01-01 00:00:00',
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

    private function mockSmsTransactionResponse(
        string $serviceId,
        int $transactionId,
        int $phoneNumber,
        string $smsCode,
        int $serviceNumber
    ): void {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', \sprintf('sms/%s/transactions/%d', $serviceId, $transactionId))
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        'id' => 1,
                        'from' => $phoneNumber,
                        'code' => $smsCode,
                        'used' => false,
                        'send_number' => $serviceNumber,
                        'value' => 0.25,
                        'send_at' => '2021-01-01 00:00:00',
                    ],
                ],
            ));
    }
}
