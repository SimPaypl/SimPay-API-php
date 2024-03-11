<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class DirectBillingTransactionCreate
{
    public string $transactionId;
    public string $redirectUrl;

    private function __construct(string $transactionId, string $redirectUrl)
    {
        $this->transactionId = $transactionId;
        $this->redirectUrl = $redirectUrl;
    }

    public static function createFromResponse(array $data): self
    {
        return new self($data['transaction_id'], $data['redirect_url'],);
    }
}
