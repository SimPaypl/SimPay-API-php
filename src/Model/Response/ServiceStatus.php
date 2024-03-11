<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class ServiceStatus implements \Stringable
{
    public string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function create(string $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
