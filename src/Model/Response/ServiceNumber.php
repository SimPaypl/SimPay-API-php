<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class ServiceNumber implements \Stringable
{
    public int $value;

    public function __construct(int $serviceNumber)
    {
        $this->value = $serviceNumber;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
