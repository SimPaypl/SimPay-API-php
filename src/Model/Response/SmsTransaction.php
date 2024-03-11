<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class SmsTransaction
{
    public int $id;
    public int $from;
    public string $code;
    public bool $used;
    public ServiceNumber $sendNumber;
    public float $value;
    public \DateTimeImmutable $sendAt;

    private function __construct(
        int $id,
        int $from,
        string $code,
        bool $used,
        ServiceNumber $sendNumber,
        float $value,
        \DateTimeImmutable $sendAt
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->code = $code;
        $this->used = $used;
        $this->sendNumber = $sendNumber;
        $this->value = $value;
        $this->sendAt = $sendAt;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['id'],
            $data['from'],
            $data['code'],
            $data['used'],
            new ServiceNumber($data['send_number']),
            $data['value'],
            new \DateTimeImmutable($data['send_at']),
        );
    }
}
