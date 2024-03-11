<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class ServiceId implements \Stringable
{
    private string $value;

    public function __construct(string $serviceId)
    {
        if (!\preg_match('/^[0-9a-f]{8}$/', $serviceId)) {
            throw new \InvalidArgumentException('Invalid service id');
        }

        $this->value = $serviceId;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
