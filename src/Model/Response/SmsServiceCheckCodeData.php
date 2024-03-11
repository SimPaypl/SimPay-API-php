<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class SmsServiceCheckCodeData
{
    public bool $used;
    public string $code;
    public bool $test;
    public int $from;
    public ServiceNumber $number;
    public float $value;
    public ?\DateTimeInterface $usedAt = null;
    private function __construct(
        bool $used,
        string $code,
        bool $test,
        int $from,
        ServiceNumber $number,
        float $value,
        ?\DateTimeInterface $usedAt = null
    ) {
        $this->used = $used;
        $this->code = $code;
        $this->test = $test;
        $this->from = $from;
        $this->number = $number;
        $this->value = $value;
        $this->usedAt = $usedAt;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['used'],
            $data['code'],
            $data['test'],
            $data['from'],
            new ServiceNumber($data['number']),
            $data['value'],
            isset($data['used_at']) ? new \DateTimeImmutable($data['used_at']) : null,
        );
    }
}
