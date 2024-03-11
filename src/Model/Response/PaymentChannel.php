<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class PaymentChannel
{
    public string $id;
    public string $name;
    public string $type;
    public string $img;
    public float $commission;
    public array $currencies;
    public Amount $amount;
    private function __construct(
        string $id,
        string $name,
        string $type,
        string $img,
        float $commission,
        array $currencies,
        Amount $amount
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->img = $img;
        $this->commission = $commission;
        $this->currencies = $currencies;
        $this->amount = $amount;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['type'],
            $data['img'],
            $data['commission'],
            $data['currencies'],
            Amount::createFromResponse($data['amount']),
        );
    }
}
