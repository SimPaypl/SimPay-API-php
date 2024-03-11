<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class ServiceType implements \Stringable
{
    public string $value;

    private function __construct(string $type)
    {
        $this->value = $type;
    }

    public static function create(string $type): self
    {
        return new self($type);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
