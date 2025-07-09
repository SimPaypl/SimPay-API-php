<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class DirectChannel implements RequestInterface
{
    private string $value;

    public function __construct(string $directChannel)
    {
        if ('' === $directChannel || '0' === $directChannel) {
            throw new \InvalidArgumentException('Direct channel cannot be empty');
        }

        $this->value = $directChannel;
    }

    public function toArray(): array
    {
        return [
            'directChannel' => $this->value,
        ];
    }
}
