<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class PaymentServiceTransactionStatus
{
    public const NEW = 'transaction_new';
    public const CONFIRMED = 'transaction_confirmed';
    public const GENERATED = 'transaction_generated';
    public const PAID = 'transaction_paid';
    public const FAILED = 'transaction_failed';
    public const EXPIRED = 'transaction_expired';
    public const CANCELED = 'transaction_canceled';

    public string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
