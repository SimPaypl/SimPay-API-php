<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

interface RequestInterface
{
    public function toArray(): array;
}
