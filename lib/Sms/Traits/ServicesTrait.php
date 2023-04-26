<?php

namespace SimPay\API\Sms\Traits;

trait ServicesTrait
{
    /**
     * @return mixed
     */
    public function getServices(int $page = 1, int $limit = 15)
    {
        return $this->guzzle->request('GET', '/sms', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * @return mixed
     */
    public function getService(string $serviceId)
    {
        return $this->guzzle->request('GET', '/sms/'.$serviceId);
    }

    /**
     * @return mixed
     */
    public function getServiceNumbers(string $serviceId, int $page = 1, int $limit = 15)
    {
        return $this->guzzle->request('GET', '/sms/'.$serviceId.'/numbers', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * @return mixed
     */
    public function getServiceNumber(string $serviceId, int $number)
    {
        return $this->guzzle->request('GET', '/sms/'.$serviceId.'/numbers/'.$number);
    }

    /**
     * @return mixed
     */
    public function getSmsCode(string $serviceId, string $code, int $number = null)
    {
        return $this->guzzle->request('POST', '/sms/'.$serviceId, [
            'code' => $code,
            'number' => $number,
        ]);
    }
}
