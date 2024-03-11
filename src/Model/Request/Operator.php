<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class Operator implements RequestInterface
{
    public const ORANGE = 'orange';
    public const PLAY = 'play';
    public const T_MOBILE = 't-mobile';
    public const PLUS = 'plus';
    private string $value;

    public function __construct(string $value)
    {
        if (!\in_array($value, [self::ORANGE, self::PLAY, self::T_MOBILE, self::PLUS], true)) {
            throw new \InvalidArgumentException('Invalid operator');
        }
        $this->value = $value;
    }

    public function toArray(): array
    {
        return [
            'operator' => $this->value,
        ];
    }
}
