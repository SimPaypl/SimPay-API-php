<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class PaymentTransactionId implements \Stringable
{
    private string $value;

    public function __construct(
        string $transactionId
    ) {
        if (!\preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $transactionId)) {
            throw new \InvalidArgumentException('Invalid transaction id');
        }
        $this->value = $transactionId;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
