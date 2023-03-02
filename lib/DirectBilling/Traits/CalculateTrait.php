<?php

namespace SimPay\API\DirectBilling\Traits;

trait CalculateTrait
{
    /**
     * @return mixed
     */
    public function calculate(int $serviceId, float $amount)
    {
        return $this->guzzle->request('GET', '/directbilling/'.$serviceId.'/calculate', [
            'amount' => $amount,
        ]);
    }
}
