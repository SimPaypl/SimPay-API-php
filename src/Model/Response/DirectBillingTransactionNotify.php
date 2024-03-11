<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class DirectBillingTransactionNotify
{
    public bool $isSend;
    public \DateTimeImmutable $lastSendAt;
    public int $count;

    private function __construct(bool $isSend, \DateTimeImmutable $lastSendAt, int $count)
    {
        $this->isSend = $isSend;
        $this->lastSendAt = $lastSendAt;
        $this->count = $count;
    }

    public static function createFromResponse(array $data): self
    {
        return new self($data['is_send'], new \DateTimeImmutable($data['last_send_at']), $data['count'],);
    }
}
