<?php

declare(strict_types=1);

namespace Simpay\Test;

use Simpay\DirectBillingCalculateApi;
use Simpay\Model\Request\Amount;
use Simpay\Model\Request\ServiceId;

final class DirectBillingCalculateApiTest extends BaseTestCase
{
    /**
     * @test
     */
    public function should_return_direct_billing_service_calculate(): void
    {
        //GIVEN
        $serviceId = 'd151e4f9';
        $amount = 1.23;
        $this->mockApiResponse($serviceId, $amount);
        $directBillingApi = new DirectBillingCalculateApi($this->factory);

        //WHEN
        $response = $directBillingApi->directBillingServiceCalculate(new ServiceId($serviceId), new Amount($amount));

        //THEN
        $this->assertSame(285.72, $response->orange->net);
        $this->assertSame(351.44, $response->orange->gross);
        $this->assertSame(285.72, $response->play->net);
        $this->assertSame(351.44, $response->play->gross);
        $this->assertNull($response->tMobile);
        $this->assertNull($response->plus);
    }

    private function mockApiResponse(string $serviceId, float $amount): void
    {
        $this->mockClientRequest(
            'GET',
            \sprintf('directbilling/%s/calculate', $serviceId),
            [
                'query' => [
                    'amount' => $amount,
                ],
            ],
        )->willReturn($this->mockResponse(
            [
                'status' => 'success',
                'data' => [
                    'orange' => [
                        'net' => 285.72,
                        'gross' => 351.44,
                    ],
                    'play' => [
                        'net' => 285.72,
                        'gross' => 351.44,
                    ],
                    't-mobile' => null,
                    'plus' => null,
                ],
            ],
        ));
    }
}
