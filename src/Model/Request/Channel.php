<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class Channel implements \Stringable
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('Channel ID cannot be empty');
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
