<?php

declare(strict_types=1);

namespace Simpay\Test;

use Simpay\DirectBillingApi;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Response\Pagination;

final class DirectBillingApiTest extends BaseTestCase
{
    /**
     * @test
     */
    public function should_return_list_of_services(): void
    {
        //GIVEN
        $this->mockDirectBillingApiResponse();
        $directBillingApi = new DirectBillingApi($this->factory);

        //WHEN
        $response = $directBillingApi->directBillingGetServices();

        //THEN
        $this->assertPagination($response->pagination);

        $this->assertSame('d151e4f9', $response->data[0]->id);
        $this->assertSame('Test service', $response->data[0]->name);
        $this->assertSame('Test1', $response->data[0]->suffix);
        $this->assertSame('service_blocked', $response->data[0]->status->value);
        $this->assertSame(
            '2021-11-08T18:19:16+01:00',
            $response->data[0]->createdAt->format(\DateTimeInterface::ATOM),
        );
    }

    /**
     * @test
     */
    public function should_return_service(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $this->mockDirectBillingServiceApiResponse($serviceId);
        $directBillingApi = new DirectBillingApi($this->factory);

        //WHEN
        $response = $directBillingApi->directBillingService(new ServiceId('d151e4f9'));

        //THEN
        $this->assertSame('d151e4f9', $response->id);
        $this->assertSame('Test service', $response->name);
        $this->assertSame('Test1', $response->suffix);
        $this->assertSame('service_new', $response->status->value);
        $this->assertSame('2021-11-08T18:19:16+01:00', $response->createdAt->format(\DateTimeInterface::ATOM));
    }

    private function mockDirectBillingApiResponse(): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', 'directbilling')
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        [
                            'id' => 'd151e4f9',
                            'name' => 'Test service',
                            'suffix' => 'Test1',
                            'status' => 'service_blocked',
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

    private function mockDirectBillingServiceApiResponse(string $serviceId): void
    {
        $this->client->expects($this->once())
            ->method('request')
            ->with('GET', \sprintf('directbilling/%s', $serviceId))
            ->willReturn($this->mockResponse(
                [
                    'status' => 'success',
                    'data' => [
                        'id' => $serviceId,
                        'name' => 'Test service',
                        'suffix' => 'Test1',
                        'status' => 'service_new',
                        'created_at' => '2021-11-08T18:19:16+01:00',
                    ],
                ],
            ));
    }

    public function assertPagination(Pagination $pagination): void
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
