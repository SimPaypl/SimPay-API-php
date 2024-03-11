<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class PaymentTransactionRedirect
{
    public ?string $success;
    public ?string $failure;

    private function __construct(?string $success, ?string $failure)
    {
        $this->success = $success;
        $this->failure = $failure;
    }

    public static function createFromResponse(array $data): self
    {
        return new self($data['success'], $data['failure']);
    }
}
