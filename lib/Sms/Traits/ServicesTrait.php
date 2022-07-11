<?php

namespace SimPay\API\Sms\Traits;

trait ServicesTrait
{

    public function getServices(int $page = 1, int $limit = 15)
    {
        return $this->guzzle->request('GET', '/sms', [
            'page' => $page,
            'limit' => $limit
        ]);
    }

    public function getService(int $serviceId)
    {
        return $this->guzzle->request('GET', '/sms/'.$serviceId);
    }

    public function getServiceNumbers(int $serviceId, int $page = 1, int $limit = 15)
    {
        return $this->guzzle->request('GET', '/sms/'.$serviceId.'/numbers', [
            'page' => $page,
            'limit' => $limit
        ]);
    }

    public function getServiceNumber(int $serviceId, int $number)
    {
        return $this->guzzle->request('GET', '/sms/'.$serviceId.'/numbers/'.$number);
    }

    public function getSmsCode(int $serviceId, string $code, int $number = null)
    {
        return $this->guzzle->request('POST', '/sms/'.$serviceId, [
            'code' => $code,
            'number' => $number
        ]);
    }

}