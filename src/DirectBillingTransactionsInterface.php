<?php

declare(strict_types=1);

namespace Simpay;

use Simpay\Model\Request\DirectBillingTransaction;
use Simpay\Model\Request\Filters;
use Simpay\Model\Request\PaymentTransactionId;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Response\DirectBillingTransactionCollection;
use Simpay\Model\Response\DirectBillingTransactionCreate;

interface DirectBillingTransactionsInterface
{
    public function directBillingTransactions(
        ServiceId $serviceId,
        ?Filters $filters = null
    ): DirectBillingTransactionCollection;

    public function directBillingTransactionCreate(
        ServiceId $serviceId,
        DirectBillingTransaction $request
    ): DirectBillingTransactionCreate;

    public function directBillingTransaction(
        ServiceId $serviceId,
        PaymentTransactionId $transactionId
    ): Model\Response\DirectBillingTransaction;
}
