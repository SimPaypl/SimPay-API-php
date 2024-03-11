<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class CallbackReturnUrl implements RequestInterface
{
    private string $success;
    private string $failure;

    public function __construct(string $success, string $failure)
    {
        $this->success = $success;
        $this->failure = $failure;
    }

    public function toArray(): array
    {
        return [
            'returns' => [
                'success' => $this->success,
                'failure' => $this->failure,
            ],
        ];
    }
}
