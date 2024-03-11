<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class PhoneNumber implements RequestInterface
{
    private string $value;

    public function __construct(string $value)
    {
        if ('' === $value || '0' === $value) {
            throw new \InvalidArgumentException('Phone number cannot be empty');
        }

        $this->value = $value;
    }

    public function toArray(): array
    {
        return [
            'phone_number' => $this->value,
        ];
    }
}
