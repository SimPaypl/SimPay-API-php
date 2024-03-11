<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class SmsCode implements \Stringable, RequestInterface
{
    private string $value;

    public function __construct(string $value)
    {
        if (!\preg_match('/^[A-Z0-9]{6}$/', $value)) {
            throw new \InvalidArgumentException('Invalid sms code');
        }
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return [
            'code' => $this->value,
        ];
    }
}
