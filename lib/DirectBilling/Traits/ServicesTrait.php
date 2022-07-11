<?php

namespace SimPay\API\DirectBilling\Traits;

trait ServicesTrait
{

    public function getServices(int $page = 1, int $limit = 15)
    {
        return $this->guzzle->request('GET', '/directbilling', [
            'page' => $page,
            'limit' => $limit
        ]);
    }

    public function getService(int $serviceId)
    {
        return $this->guzzle->request('GET', '/directbilling/'.$serviceId);
    }

}