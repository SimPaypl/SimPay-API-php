<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class Customer implements RequestInterface
{
    private ?string $name;
    private ?string $email;
    private ?string $ip;
    private ?string $countryCode;

    public function __construct(
        ?string $name = null,
        ?string $email = null,
        ?string $ip = null,
        ?string $countryCode = null
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->ip = $ip;
        $this->countryCode = $countryCode;
    }

    public function toArray(): array
    {
        return [
            'customer' => [
                'name' => $this->name,
                'email' => $this->email,
                'ip' => $this->ip,
                'countryCode' => $this->countryCode,
            ],
        ];
    }
}
