<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class CallbackReturnUrl
{
    public string $success;
    public string $failure;

    private function __construct(string $success, string $failure)
    {
        $this->success = $success;
        $this->failure = $failure;
    }

    public static function create(string $success, string $failure): self
    {
        return new self($success, $failure);
    }
}
