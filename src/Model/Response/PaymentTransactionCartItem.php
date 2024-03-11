<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class PaymentTransactionCartItem
{
    public string $name;
    public int $quantity;
    public float $price;
    public string $producer;
    public string $category;
    public string $code;

    private function __construct(
        string $name,
        int $quantity,
        float $price,
        string $producer,
        string $category,
        string $code
    ) {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->producer = $producer;
        $this->category = $category;
        $this->code = $code;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['name'],
            $data['quantity'],
            $data['price'],
            $data['producer'],
            $data['category'],
            $data['code'],
        );
    }
}
