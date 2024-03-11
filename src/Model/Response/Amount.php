<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class Amount
{
    public float $min;
    public float $max;

    private function __construct(float $min, float $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public static function createFromResponse(array $data): self
    {
        return new self($data['min'], $data['max']);
    }
}
