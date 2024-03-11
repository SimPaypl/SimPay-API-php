<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class Operator implements \Stringable
{
    public string $value;

    public function __construct(string $operator)
    {
        $this->value = $operator;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
