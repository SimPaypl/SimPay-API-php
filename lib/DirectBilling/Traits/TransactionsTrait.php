<?php

namespace SimPay\API\DirectBilling\Traits;

trait TransactionsTrait
{
    /**
     * @return mixed
     */
    public function getTransactions(string $serviceId, int $page = 1, int $limit = 15)
    {
        return $this->guzzle->request('GET', '/directbilling/'.$serviceId.'/transactions', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * @return mixed
     */
    public function getTransaction(string $serviceId, string $transactionId)
    {
        return $this->guzzle->request('GET', '/directbilling/'.$serviceId.'/transactions/'.$transactionId);
    }
}
