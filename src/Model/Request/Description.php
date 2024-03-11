<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class Description implements RequestInterface
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function toArray(): array
    {
        return [
            'description' => $this->value,
        ];
    }
}
