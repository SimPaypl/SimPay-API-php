<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class ServiceCalculationOperatorAmount
{
    public ?float $net;
    public ?float $gross;

    private function __construct(?float $net, ?float $gross)
    {
        $this->net = $net;
        $this->gross = $gross;
    }

    public static function createFromResponse(array $data): self
    {
        return new self($data['net'], $data['gross'],);
    }
}
