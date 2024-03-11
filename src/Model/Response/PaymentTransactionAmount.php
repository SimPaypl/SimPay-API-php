<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class PaymentTransactionAmount
{
    public float $value;
    public string $currency;
    public float $commission;

    private function __construct(float $value, string $currency, float $commission)
    {
        $this->value = $value;
        $this->currency = $currency;
        $this->commission = $commission;
    }

    public static function createFromResponse(array $data): self
    {
        return new self($data['value'], $data['currency'], $data['commission']);
    }
}
