<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class DirectBillingTransactionStatus implements RequestInterface
{
    public const STATUS_NEW = 'transaction_db_new';
    public const STATUS_CONFIRMED = 'transaction_db_confirmed';
    public const STATUS_PAYED = 'transaction_db_payed';
    public const STATUS_REJECTED = 'transaction_db_rejected';

    public const STATUSES = [self::STATUS_NEW, self::STATUS_CONFIRMED, self::STATUS_PAYED, self::STATUS_REJECTED, ];

    private string $value;

    private function __construct(string $value)
    {
        if (!\in_array($value, self::STATUSES, true)) {
            throw new \InvalidArgumentException('Invalid status');
        }
        $this->value = $value;
    }

    public static function new(): self
    {
        return new self(self::STATUS_NEW);
    }

    public static function confirmed(): self
    {
        return new self(self::STATUS_CONFIRMED);
    }

    public static function payed(): self
    {
        return new self(self::STATUS_PAYED);
    }

    public static function rejected(): self
    {
        return new self(self::STATUS_REJECTED);
    }

    public function toArray(): array
    {
        return [
            'status' => $this->value,
        ];
    }
}
