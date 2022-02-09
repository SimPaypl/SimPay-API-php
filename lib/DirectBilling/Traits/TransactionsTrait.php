<?php

namespace SimPay\API\DirectBilling\Traits;

trait TransactionsTrait
{

    public function getTransactions(int $serviceId, int $page = 1, int $limit = 15) {
        return $this->guzzle->request('GET', '/directbilling/' . $serviceId . '/transactions', [
            'page' => $page,
            'limit' => $limit
        ]);
    }

    public function getTransaction(int $serviceId, int $transactionId) {
        return $this->guzzle->request('GET', '/directbilling/' . $serviceId . '/transactions/' . $transactionId);
    }

}