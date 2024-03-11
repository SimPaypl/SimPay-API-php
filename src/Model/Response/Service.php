<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class Service
{
    public string $id;
    public string $name;
    public \DateTimeImmutable $createdAt;
    public string $suffix;
    public ServiceStatus $status;

    private function __construct(
        string $id,
        string $name,
        string $suffix,
        ServiceStatus $status,
        \DateTimeImmutable $createdAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->suffix = $suffix;
        $this->status = $status;
        $this->createdAt = $createdAt;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['suffix'],
            ServiceStatus::create($data['status']),
            new \DateTimeImmutable($data['created_at']),
        );
    }
}
