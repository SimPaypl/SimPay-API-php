<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class PaymentServiceTransactionStatus
{
    public const NEW = 'transaction_new';
    public const CONFIRMED = 'transaction_confirmed';
    public const GENERATED = 'transaction_generated';
    public const PAID = 'transaction_paid';
    public const FAILED = 'transaction_failure';
    public const EXPIRED = 'transaction_expired';
    public const REFUNDED = 'transaction_refunded';
    public const FRAUD = 'transaction_fraud';
    public const FRAUD_POSSIBILITY = 'transaction_fraud_possibility';
    /** @deprecated The API never returns this status. */
    public const CANCELED = 'transaction_canceled';

    public string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
