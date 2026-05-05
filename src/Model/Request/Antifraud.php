<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class Antifraud implements RequestInterface
{
    private ?string $useragent;
    private ?int $steamid;
    private ?string $mcusername;
    private ?string $mcid;

    public function __construct(
        ?string $useragent = null,
        ?int $steamid = null,
        ?string $mcusername = null,
        ?string $mcid = null
    ) {
        $this->useragent = $useragent;
        $this->steamid = $steamid;
        $this->mcusername = $mcusername;
        $this->mcid = $mcid;
    }

    public function toArray(): array
    {
        return [
            'antifraud' => [
                'useragent' => $this->useragent,
                'steamid' => $this->steamid,
                'mcusername' => $this->mcusername,
                'mcid' => $this->mcid,
            ],
        ];
    }
}
