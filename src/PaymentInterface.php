<?php

declare(strict_types=1);

namespace Simpay;

use Simpay\Model\Request\CreatePayment;
use Simpay\Model\Request\PaymentTransactionId;
use Simpay\Model\Request\ServiceId;

interface PaymentInterface
{
    public function paymentGetServices(): Model\Response\PaymentServiceCollection;

    public function paymentGetService(ServiceId $serviceId): Model\Response\PaymentService;

    public function paymentGetTransactions(ServiceId $serviceId): Model\Response\PaymentServiceTransactionCollection;

    public function paymentGetChannels(ServiceId $serviceId): Model\Response\PaymentChannelCollection;

    public function paymentTransactionCreate(
        ServiceId $serviceId,
        CreatePayment $request
    ): Model\Response\PaymentCreate;

    public function paymentGetTransaction(
        ServiceId $serviceId,
        PaymentTransactionId $transactionId
    ): Model\Response\PaymentTransaction;
}
