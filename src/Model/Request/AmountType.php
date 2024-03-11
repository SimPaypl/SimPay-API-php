<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class AmountType implements RequestInterface
{
    public const REQUIRED = 'required';
    public const NET = 'net';
    public const GROSS = 'gross';
    private string $value;

    public function __construct(string $type)
    {
        if (!\in_array($type, [self::REQUIRED, self::NET, self::GROSS], true)) {
            throw new \InvalidArgumentException('Invalid amount type');
        }
        $this->value = $type;
    }

    public static function createRequired(): self
    {
        return new self(self::REQUIRED);
    }

    public static function createNet(): self
    {
        return new self(self::NET);
    }

    public static function createGross(): self
    {
        return new self(self::GROSS);
    }

    public function toArray(): array
    {
        return [
            'amount_type' => $this->value,
        ];
    }
}
