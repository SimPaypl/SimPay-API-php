<?php

namespace SimPay\API;

use SimPay\API\Adapter\Guzzle;
use SimPay\API\DirectBilling\DirectBilling;
use SimPay\API\Sms\Sms;
use SimPay\API\SmsXml\SmsXml;

class SimPay
{

    private Guzzle $guzzle;

    public function __construct(string $apiKey, string $apiPassword)
    {
        $this->guzzle = new Guzzle(new Authorization($apiKey, $apiPassword));
    }

    public function sms(): Sms
    {
        return new Sms($this->guzzle);
    }

    public function smsXml(string $hashKey): SmsXml
    {
        return new SmsXml($hashKey);
    }

    public function directbilling(): DirectBilling
    {
        return new DirectBilling($this->guzzle);
    }

}