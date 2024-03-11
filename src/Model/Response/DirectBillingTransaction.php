<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class DirectBillingTransaction
{
    public string $id;
    public string $status;
    public ?string $phoneNumber;
    public ?string $control;
    public float $value;
    public float $valueNetto;
    public ?Operator $operator;
    public DirectBillingTransactionNotify $notify;
    public \DateTimeImmutable $createdAt;
    public \DateTimeImmutable $updatedAt;

    private function __construct(
        string $id,
        string $status,
        ?string $phoneNumber,
        ?string $control,
        float $value,
        float $valueNetto,
        ?Operator $operator,
        DirectBillingTransactionNotify $notify,
        \DateTimeImmutable $createdAt,
        \DateTimeImmutable $updatedAt
    ) {
        $this->id = $id;
        $this->status = $status;
        $this->phoneNumber = $phoneNumber;
        $this->control = $control;
        $this->value = $value;
        $this->valueNetto = $valueNetto;
        $this->operator = $operator;
        $this->notify = $notify;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['id'],
            $data['status'],
            $data['phone_number'],
            $data['control'],
            $data['value'],
            $data['value_netto'],
            new Operator($data['operator']),
            DirectBillingTransactionNotify::createFromResponse($data['notify']),
            new \DateTimeImmutable($data['created_at']),
            new \DateTimeImmutable($data['updated_at']),
        );
    }
}
