<?php

namespace SimPay\API\DirectBilling\Traits;

trait ServicesTrait
{
    /**
     * @return mixed
     */
    public function getServices(int $page = 1, int $limit = 15)
    {
        return $this->guzzle->request('GET', '/directbilling', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * @return mixed
     */
    public function getService(string $serviceId)
    {
        return $this->guzzle->request('GET', '/directbilling/'.$serviceId);
    }
}
