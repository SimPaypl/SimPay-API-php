<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class AmountType
{
    public string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
