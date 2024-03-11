<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class CartItem implements RequestInterface
{
    private string $name;
    private int $quantity;
    private float $price;
    private string $producer;
    private string $category;
    private string $code;

    public function __construct(
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

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'producer' => $this->producer,
            'category' => $this->category,
            'code' => $this->code,
        ];
    }
}
