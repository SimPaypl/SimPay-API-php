<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class Currency implements RequestInterface
{
    public const DEFAULT_CURRENCY = 'PLN';
    private string $value = self::DEFAULT_CURRENCY;

    public function __construct(string $currency)
    {
        if ('' === $currency || '0' === $currency) {
            throw new \InvalidArgumentException('Currency cannot be empty');
        }

        $this->value = $currency;
    }

    public static function createDefault(): self
    {
        return new self(self::DEFAULT_CURRENCY);
    }

    public function toArray(): array
    {
        return [
            'currency' => $this->value,
        ];
    }
}
