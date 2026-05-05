<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class SteamId implements RequestInterface
{
    private string $value;

    public function __construct(string $id)
    {
        $this->value = $id;
    }

    public function toArray(): array
    {
        return [
            'steamid' => $this->value,
        ];
    }
}
