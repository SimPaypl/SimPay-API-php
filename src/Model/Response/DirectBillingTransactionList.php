<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class DirectBillingTransactionList
{
    public string $id;
    public string $status;
    public float $value;
    public float $valueNetto;
    public string $operator;
    public \DateTimeImmutable $createdAt;
    public \DateTimeImmutable $updatedAt;

    private function __construct(
        string $id,
        string $status,
        float $value,
        float $valueNetto,
        string $operator,
        \DateTimeImmutable $createdAt,
        \DateTimeImmutable $updatedAt
    ) {
        $this->id = $id;
        $this->status = $status;
        $this->value = $value;
        $this->valueNetto = $valueNetto;
        $this->operator = $operator;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['id'],
            $data['status'],
            $data['value'],
            $data['value_netto'],
            $data['operator'],
            new \DateTimeImmutable($data['created_at']),
            new \DateTimeImmutable($data['updated_at']),
        );
    }
}
