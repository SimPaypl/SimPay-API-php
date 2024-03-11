<?php

declare(strict_types=1);

namespace Simpay\Test;

use Simpay\Model\Request\ServiceId;
use Simpay\Model\Request\ServiceNumber;
use Simpay\Model\Request\SmsNumber;
use Simpay\Model\Response\Pagination;
use Simpay\SmsNumberApi;

final class SmsNumberApiTest extends BaseTestCase
{
    /**
     * @test
     */
    public function should_return_sms_numbers_list(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $number = ServiceNumber::SERVICE_NUMBER_7055;
        $value = 42.10;
        $valueNet = 34.30;
        $this->mockSmsNumbersListResponse($serviceId, $number, $value, $valueNet);
        $smsNumbersApi = new SmsNumberApi($this->factory);

        //WHEN
        $smsNumbersResponse = $smsNumbersApi->smsServiceNumbersList(new ServiceId($serviceId));

        //THEN
        $this->assertSame($number, $smsNumbersResponse->data[0]->number->value);
        $this->assertSame($value, $smsNumbersResponse->data[0]->value);
        $this->assertSame($valueNet, $smsNumbersResponse->data[0]->valueNet);
        $this->assertFalse($smsNumbersResponse->data[0]->adult);

        $this->assertPagination($smsNumbersResponse->pagination);
    }

    /**
     * @test
     */
    public function should_return_sms_service_number(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $number = 7055;
        $value = 42.10;
        $valueNet = 34.30;
        $this->mockSmsServiceNumberResponse($serviceId, $number, $value, $valueNet);
        $smsNumbersApi = new SmsNumberApi($this->factory);

        //WHEN
        $smsNumber = $smsNumbersApi->smsServiceNumber(new ServiceId($serviceId), new SmsNumber($number));

        //THEN
        $this->assertSame($number, $smsNumber->number->value);
        $this->assertSame($value, $smsNumber->value);
        $this->assertSame($valueNet, $smsNumber->valueNet);
        $this->assertFalse($smsNumber->adult);
    }

    /**
     * @test
     */
    public function should_return_sms_numbers(): void
    {
        //GIVEN
        $number = 7055;
        $value = 42.10;
        $valueNet = 34.30;
        $this->mockSmsNumbersResponse($number, $value, $valueNet);
        $smsNumbersApi = new SmsNumberApi($this->factory);

        //WHEN
        $smsNumbersResponse = $smsNumbersApi->smsNumbers();

        //THEN
        $this->assertSame($number, $smsNumbersResponse->data[0]->number->value);
        $this->assertSame($value, $smsNumbersResponse->data[0]->value);
        $this->assertSame($valueNet, $smsNumbersResponse->data[0]->valueNet);
        $this->assertFalse($smsNumbersResponse->data[0]->adult);

        $this->assertPagination($smsNumbersResponse->pagination);
    }

    /**
     * @test
     */
    public function should_return_sms_number(): void
    {
        //GIVEN
        $number = 7055;
        $value = 42.10;
        $valueNet = 34.30;
        $this->mockSmsNumberResponse($number, $value, $valueNet);
        $smsNumbersApi = new SmsNumberApi($this->factory);

        //WHEN
        $smsNumber = $smsNumbersApi->smsNumber(new SmsNumber($number));

        //THEN
        $this->assertSame($number, $smsNumber->number->value);
        $this->assertSame($value, $smsNumber->value);
        $this->assertSame($valueNet, $smsNumber->valueNet);
        $this->assertFalse($smsNumber->adult);
    }

    private function mockSmsNumbersListResponse(string $serviceId, int $number, float $value, float $valueNet): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', \sprintf('sms/%s/numbers', $serviceId))
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        [
                            'number' => $number,
                            'value' => $value,
                            'value_net' => $valueNet,
                            'adult' => false,
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

    private function mockSmsServiceNumberResponse(
        string $serviceId,
        int $number,
        float $value,
        float $valueNet
    ): void {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', \sprintf('sms/%s/numbers/%d', $serviceId, $number))
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        'number' => $number,
                        'value' => $value,
                        'value_net' => $valueNet,
                        'adult' => false,
                    ],
                ],
            ));
    }

    private function mockSmsNumbersResponse(int $number, float $value, float $valueNet): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', 'sms/numbers')
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        [
                            'number' => $number,
                            'value' => $value,
                            'value_net' => $valueNet,
                            'adult' => false,
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

    private function mockSmsNumberResponse(int $number, float $value, float $valueNet): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', \sprintf('sms/numbers/%d', $number))
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        'number' => $number,
                        'value' => $value,
                        'value_net' => $valueNet,
                        'adult' => false,
                    ],
                ],
            ));
    }
}
