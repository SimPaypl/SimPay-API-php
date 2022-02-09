<?php

namespace SimPay\API\Sms\Traits;

trait NumbersTrait
{

    public function getNumbers(int $page = 1, int $limit = 15) {

        return $this->guzzle->request('GET', '/sms/numbers', [
            'page' => $page,
            'limit' => $limit
        ]);

    }

    public function getNumber(int $number, int $serviceId = null) {

        if (!$serviceId) {
            return $this->guzzle->request('GET', '/sms/numbers/' . $number);
        }

        return $this->guzzle->request('GET', '/sms/' . $serviceId . '/numbers/' . $number);

    }

}