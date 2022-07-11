<?php

namespace SimPay\API\Sms;

use SimPay\API\Traits\ComponentsTrait;
use SimPay\API\Sms\Traits\ServicesTrait;
use SimPay\API\Sms\Traits\TransactionsTrait;
use SimPay\API\Sms\Traits\NumbersTrait;
use SimPay\API\Adapter\Guzzle;

class Sms
{

    use ComponentsTrait, ServicesTrait, TransactionsTrait, NumbersTrait;

    private Guzzle $guzzle;

    public function __construct(Guzzle $guzzle)
    {
        $this->guzzle = $guzzle;
    }

}