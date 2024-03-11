<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class Control implements RequestInterface
{
    private string $value;

    public function __construct(string $value)
    {
        if ('' === $value || '0' === $value) {
            throw new \InvalidArgumentException('Control must be not empty');
        }

        $this->value = $value;
    }

    public function toArray(): array
    {
        return [
            'control' => $this->value,
        ];
    }
}
