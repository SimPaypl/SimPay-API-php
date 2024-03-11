<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class Amount implements RequestInterface
{
    private float $value;

    public function __construct(float $value)
    {
        if (0 >= $value) {
            throw new \InvalidArgumentException('Amount must be greater than 0');
        }

        $this->value = $value;
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->value,
        ];
    }
}
