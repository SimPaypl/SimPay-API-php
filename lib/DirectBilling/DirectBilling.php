<?php

namespace SimPay\API\DirectBilling;

use SimPay\API\Adapter\Guzzle;
use SimPay\API\DirectBilling\Traits\CalculateTrait;
use SimPay\API\DirectBilling\Traits\ServicesTrait;
use SimPay\API\DirectBilling\Traits\TransactionsTrait;
use SimPay\API\Traits\ComponentsTrait;

class DirectBilling
{

    use ComponentsTrait, ServicesTrait, TransactionsTrait, CalculateTrait;

    private Guzzle $guzzle;

    public function __construct(Guzzle $guzzle) {
        $this->guzzle = $guzzle;
    }

    public function payment(int $serviceId, string $hashKey): Payment {
        return new Payment($this->guzzle, $serviceId, $hashKey);
    }

}