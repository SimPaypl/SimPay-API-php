<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class SmsService
{
    public string $id;
    public ServiceType $type;
    public ServiceStatus $status;
    public string $name;
    public string $prefix;
    public string $suffix;
    public ?string $description;
    public bool $adult;
    public \DateTimeImmutable $createdAt;

    private function __construct(
        string $id,
        ServiceType $type,
        ServiceStatus $status,
        string $name,
        string $prefix,
        string $suffix,
        ?string $description,
        bool $adult,
        \DateTimeImmutable $createdAt
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->status = $status;
        $this->name = $name;
        $this->prefix = $prefix;
        $this->suffix = $suffix;
        $this->description = $description;
        $this->adult = $adult;
        $this->createdAt = $createdAt;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['id'],
            ServiceType::create($data['type']),
            ServiceStatus::create($data['status']),
            $data['name'],
            $data['prefix'],
            $data['suffix'],
            $data['description'],
            $data['adult'],
            new \DateTimeImmutable($data['created_at']),
        );
    }
}
