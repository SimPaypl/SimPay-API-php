<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class ChannelType implements RequestInterface
{
    private bool $blik;
    private bool $transfer;
    private bool $cards;
    private bool $ewallets;
    private bool $paypal;

    public function __construct(
        bool $blik = false,
        bool $transfer = false,
        bool $cards = false,
        bool $ewallets = false,
        bool $paypal = false
    ) {
        $this->blik = $blik;
        $this->transfer = $transfer;
        $this->cards = $cards;
        $this->ewallets = $ewallets;
        $this->paypal = $paypal;
    }

    public function toArray(): array
    {
        return [
            'channel_types' => [
                'blik' => $this->blik,
                'transfer' => $this->transfer,
                'cards' => $this->cards,
                'ewallets' => $this->ewallets,
                'paypal' => $this->paypal,
            ],
        ];
    }
}
