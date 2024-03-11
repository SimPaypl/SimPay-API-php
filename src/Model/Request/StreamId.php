<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class StreamId implements RequestInterface
{
    private string $value;

    public function __construct(string $id)
    {
        $this->value = $id;
    }

    public function toArray(): array
    {
        return [
            'stream_id' => $this->value,
        ];
    }
}
