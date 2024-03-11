<?php

declare(strict_types=1);

namespace Simpay\Test;

use Simpay\Model\Request\ServiceId;
use Simpay\Model\Request\ServiceNumber;
use Simpay\Model\Request\SmsCode;
use Simpay\Model\Response\Pagination;
use Simpay\SmsServiceApi;

final class SmsServiceApiTest extends BaseTestCase
{
    /**
     * @test
     */
    public function should_return_sms_services_response(): void
    {
        //GIVEN
        $serviceStatus = 'service_active';
        $this->mockSmsServicesResponse($serviceStatus);
        $smsApi = new SmsServiceApi($this->factory);

        //WHEN
        $smsServiceResponse = $smsApi->smsServiceList();

        //THEN
        $this->assertSame('d151e4f9', $smsServiceResponse->data[0]->id);
        $this->assertFalse($smsServiceResponse->data[0]->adult);
        $this->assertSame('TEST', $smsServiceResponse->data[0]->name);
        $this->assertSame('SIM', $smsServiceResponse->data[0]->prefix);
        $this->assertSame('TESTSIMPAY', $smsServiceResponse->data[0]->suffix);
        $this->assertSame('Test', $smsServiceResponse->data[0]->description);
        $this->assertSame('ONE_TIME_CODE', $smsServiceResponse->data[0]->type->value);
        $this->assertSame($serviceStatus, $smsServiceResponse->data[0]->status->value);
        $this->assertSame('2021-01-01 00:00:00', $smsServiceResponse->data[0]->createdAt->format('Y-m-d H:i:s'));

        $this->assertPagination($smsServiceResponse->pagination);
    }

    /**
     * @test
     */
    public function should_return_sms_service(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $this->mockSmsServiceResponse($serviceId);
        $smsApi = new SmsServiceApi($this->factory);

        //WHEN
        $response = $smsApi->smsServiceShow(new ServiceId($serviceId));

        //THEN
        $this->assertSame($serviceId, $response->id);
        $this->assertFalse($response->adult);
        $this->assertSame('TEST', $response->name);
        $this->assertSame('SIM', $response->prefix);
        $this->assertSame('TESTSIMPAY', $response->suffix);
        $this->assertSame('Test', $response->description);
        $this->assertSame('ONE_TIME_CODE', $response->type->value);
        $this->assertSame('service_active', $response->status->value);
        $this->assertSame('2021-01-01 00:00:00', $response->createdAt->format('Y-m-d H:i:s'));
    }

    /**
     * @test
     */
    public function should_return_sms_code_not_used(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $smsCode = '123456';
        $serviceNumber = ServiceNumber::SERVICE_NUMBER_7055;
        $phoneNumber = 48_123_123_123;
        $this->mockSmsCodeNotUsedResponse($serviceId, $smsCode, $serviceNumber, $phoneNumber);
        $smsApi = new SmsServiceApi($this->factory);

        //WHEN
        $response = $smsApi->smsServiceCheckCode(
            new ServiceId($serviceId),
            new SmsCode($smsCode),
            ServiceNumber::create($serviceNumber),
        );

        //THEN
        $this->assertFalse($response->used);
        $this->assertSame($smsCode, $response->code);
        $this->assertTrue($response->test);
        $this->assertSame($phoneNumber, $response->from);
        $this->assertSame(7055, $response->number->value);
        $this->assertSame(0.25, $response->value);
    }

    /**
     * @test
     */
    public function should_return_sms_code_used(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $smsCode = '123456';
        $serviceNumber = ServiceNumber::SERVICE_NUMBER_7055;
        $usedAt = '2021-01-01 00:00:00';
        $phoneNumber = 48_123_123_123;
        $this->mockSmsCodeUsedResponse($serviceId, $smsCode, $serviceNumber, $phoneNumber, $usedAt);
        $smsApi = new SmsServiceApi($this->factory);

        //WHEN
        $response = $smsApi->smsServiceCheckCode(
            new ServiceId($serviceId),
            new SmsCode($smsCode),
            ServiceNumber::create($serviceNumber),
        );

        //THEN
        $this->assertTrue($response->used);
        $this->assertSame($smsCode, $response->code);
        $this->assertTrue($response->test);
        $this->assertSame($phoneNumber, $response->from);
        $this->assertSame(7055, $response->number->value);
        $this->assertSame(0.25, $response->value);
        $this->assertSame($usedAt, $response->usedAt->format('Y-m-d H:i:s'));
    }

    private function mockSmsServicesResponse(string $serviceStatus): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', 'sms')
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        [
                            'id' => 'd151e4f9',
                            'type' => 'ONE_TIME_CODE',
                            'status' => $serviceStatus,
                            'name' => 'TEST',
                            'prefix' => 'SIM',
                            'suffix' => 'TESTSIMPAY',
                            'description' => 'Test',
                            'adult' => false,
                            'created_at' => '2021-01-01 00:00:00',
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

    private function mockSmsServiceResponse(string $serviceId): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', \sprintf('sms/%s', $serviceId))
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        'id' => $serviceId,
                        'type' => 'ONE_TIME_CODE',
                        'status' => 'service_active',
                        'name' => 'TEST',
                        'prefix' => 'SIM',
                        'suffix' => 'TESTSIMPAY',
                        'description' => 'Test',
                        'adult' => false,
                        'created_at' => '2021-01-01 00:00:00',
                    ],
                ],
            ));
    }

    private function mockSmsCodeNotUsedResponse(
        string $serviceId,
        string $smsCode,
        int $serviceNumber,
        int $phoneNumber
    ): void {
        $this->client->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                \sprintf('sms/%s', $serviceId),
                [
                    'json' => [
                        'code' => $smsCode,
                        'number' => $serviceNumber,
                    ],
                ],
            )
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        'used' => false,
                        'code' => $smsCode,
                        'test' => true,
                        'from' => $phoneNumber,
                        'number' => $serviceNumber,
                        'value' => 0.25,
                    ],
                ],
            ));
    }

    private function mockSmsCodeUsedResponse(
        string $serviceId,
        string $smsCode,
        int $serviceNumber,
        int $phoneNumber,
        string $usedAt
    ): void {
        $this->client->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                \sprintf('sms/%s', $serviceId),
                [
                    'json' => [
                        'code' => $smsCode,
                        'number' => $serviceNumber,
                    ],
                ],
            )
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        'used' => true,
                        'code' => $smsCode,
                        'test' => true,
                        'from' => $phoneNumber,
                        'number' => $serviceNumber,
                        'value' => 0.25,
                        'used_at' => $usedAt,
                    ],
                ],
            ));
    }
}
