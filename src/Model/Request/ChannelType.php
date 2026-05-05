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
    private bool $paysafe;
    private bool $latam;
    private bool $postponed;

    public function __construct(
        bool $blik = false,
        bool $transfer = false,
        bool $cards = false,
        bool $ewallets = false,
        bool $paypal = false,
        bool $paysafe = false,
        bool $latam = false,
        bool $postponed = false
    ) {
        $this->blik = $blik;
        $this->transfer = $transfer;
        $this->cards = $cards;
        $this->ewallets = $ewallets;
        $this->paypal = $paypal;
        $this->paysafe = $paysafe;
        $this->latam = $latam;
        $this->postponed = $postponed;
    }

    public function toArray(): array
    {
        return [
            'channelTypes' => [
                'blik' => $this->blik,
                'transfer' => $this->transfer,
                'cards' => $this->cards,
                'ewallets' => $this->ewallets,
                'paypal' => $this->paypal,
                'paysafe' => $this->paysafe,
                'latam' => $this->latam,
                'postponed' => $this->postponed,
            ],
        ];
    }
}
