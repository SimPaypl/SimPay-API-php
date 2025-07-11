<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class PaymentTransaction
{
    public string $id;
    public string $status;
    public PaymentTransactionAmount $amount;
    public string $channel;
    public ?string $control;
    public ?string $description;
    public PaymentTransactionRedirect $redirects;
    public PaymentTransactionCustomer $customer;
    public PaymentTransactionAddress $billing;
    public PaymentTransactionAddress $shipping;
    /**
     * @var PaymentTransactionCartItem[]|null
     */
    public ?array $cart;
    public \DateTimeImmutable $paidAt;
    public ?\DateTimeImmutable $expiresAt;
    public \DateTimeImmutable $createdAt;
    public \DateTimeImmutable $updatedAt;

    private function __construct(
        string $id,
        string $status,
        PaymentTransactionAmount $amount,
        string $channel,
        ?string $control,
        ?string $description,
        PaymentTransactionRedirect $redirects,
        PaymentTransactionCustomer $customer,
        PaymentTransactionAddress $billing,
        PaymentTransactionAddress $shipping,
        ?array $cart,
        \DateTimeImmutable $paidAt,
        ?\DateTimeImmutable $expiresAt,
        \DateTimeImmutable $createdAt,
        \DateTimeImmutable $updatedAt
    ) {
        $this->id = $id;
        $this->status = $status;
        $this->amount = $amount;
        $this->channel = $channel;
        $this->control = $control;
        $this->description = $description;
        $this->redirects = $redirects;
        $this->customer = $customer;
        $this->billing = $billing;
        $this->shipping = $shipping;
        $this->cart = $cart;
        $this->paidAt = $paidAt;
        $this->expiresAt = $expiresAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function createFromResponse(array $data): self
    {
        $cartItems = [];

        foreach (($data['cart'] ?? []) as $cartItem) {
            $cartItems[] = PaymentTransactionCartItem::createFromResponse($cartItem);
        }

        return new self(
            $data['id'],
            $data['status'],
            PaymentTransactionAmount::createFromResponse($data['amount']),
            $data['channel'],
            $data['control'],
            $data['description'],
            PaymentTransactionRedirect::createFromResponse($data['redirect']),
            PaymentTransactionCustomer::createFromResponse($data['customer']),
            PaymentTransactionAddress::createFromResponse($data['billing']),
            PaymentTransactionAddress::createFromResponse($data['shipping']),
            $cartItems,
            new \DateTimeImmutable($data['paid_at']),
            new \DateTimeImmutable($data['expires_at']),
            new \DateTimeImmutable($data['created_at']),
            new \DateTimeImmutable($data['updated_at']),
        );
    }
}
