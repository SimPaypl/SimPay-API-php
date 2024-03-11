<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class Referer implements RequestInterface
{
    private string $value;

    public function __construct(string $referer)
    {
        if ('' === $referer || '0' === $referer) {
            throw new \InvalidArgumentException('Referer cannot be empty');
        }

        $this->value = $referer;
    }

    public function toArray(): array
    {
        return [
            'referer' => $this->value,
        ];
    }
}
