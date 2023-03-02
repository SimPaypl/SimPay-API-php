<?php

namespace SimPay\API\Sms\Traits;

trait TransactionsTrait
{
    /**
     * @return mixed
     */
    public function getTransactions(int $serviceId, int $page = 1, int $limit = 15)
    {
        return $this->guzzle->request('GET', '/sms/'.$serviceId.'/transactions', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * @return mixed
     */
    public function getTransaction(int $serviceId, int $transactionId)
    {
        return $this->guzzle->request('GET', '/sms/'.$serviceId.'/transactions/'.$transactionId);
    }
}
