<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class PaymentService
{
    public string $id;
    public string $name;
    public \DateTimeImmutable $createdAt;
    public ServiceStatus $status;

    private function __construct(
        string $id,
        string $name,
        ServiceStatus $status,
        \DateTimeImmutable $createdAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->createdAt = $createdAt;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            ServiceStatus::create($data['status']),
            new \DateTimeImmutable($data['created_at']),
        );
    }
}
