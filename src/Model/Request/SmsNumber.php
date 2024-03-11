<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class SmsNumber implements \Stringable
{
    private int $value;

    public function __construct(int $number)
    {
        if (0 >= $number) {
            throw new \InvalidArgumentException('Invalid number');
        }

        $this->value = $number;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
