<?php

declare(strict_types=1);

namespace Simpay;

use Simpay\Model\Request\ServiceId;
use Simpay\Model\Request\SmsTransactionId;

interface SmsTransactionInterface
{
    public function smsTransactionsList(ServiceId $serviceId): Model\Response\SmsTransactionCollection;
    public function smsTransactionsShow(
        ServiceId $serviceId,
        SmsTransactionId $transactionId
    ): Model\Response\SmsTransaction;
}
