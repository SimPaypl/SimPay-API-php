<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class SmsTransactionId implements \Stringable
{
    private int $value;

    public function __construct(int $value)
    {
        if (0 >= $value) {
            throw new \InvalidArgumentException('Invalid transaction id');
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
