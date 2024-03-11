<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class PaymentServiceTransaction
{
    public string $id;
    public PaymentServiceTransactionStatus $status;
    public float $amount;
    public string $control;
    public string $channel;
    public \DateTimeImmutable $paidAt;
    public \DateTimeImmutable $createdAt;
    public \DateTimeImmutable $updatedAt;

    private function __construct(
        string $id,
        PaymentServiceTransactionStatus $status,
        float $amount,
        string $control,
        string $channel,
        \DateTimeImmutable $paidAt,
        \DateTimeImmutable $createdAt,
        \DateTimeImmutable $updatedAt
    ) {
        $this->id = $id;
        $this->status = $status;
        $this->amount = $amount;
        $this->control = $control;
        $this->channel = $channel;
        $this->paidAt = $paidAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['id'],
            new PaymentServiceTransactionStatus($data['status']),
            $data['amount'],
            $data['control'],
            $data['channel'],
            new \DateTimeImmutable($data['paid_at']),
            new \DateTimeImmutable($data['created_at']),
            new \DateTimeImmutable($data['updated_at']),
        );
    }
}
