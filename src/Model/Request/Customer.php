<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class Customer implements RequestInterface
{
    private string $name;
    private string $email;

    public function __construct(
        string $name,
        string $email
    ) {
        $this->name = $name;
        $this->email = $email;
    }

    public function toArray(): array
    {
        return [
            'customer' => [
                'name' => $this->name,
                'email' => $this->email,
            ],
        ];
    }
}
