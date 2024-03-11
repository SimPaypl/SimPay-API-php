<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class PaymentTransactionCustomer
{
    public ?string $name;
    public string $email;

    private function __construct(?string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public static function createFromResponse(array $data): self
    {
        return new self($data['name'], $data['email']);
    }
}
