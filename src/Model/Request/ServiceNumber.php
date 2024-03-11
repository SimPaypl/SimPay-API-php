<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class ServiceNumber implements RequestInterface
{
    public const SERVICE_NUMBER_7055 = 7055;
    public const SERVICE_NUMBER_7155 = 7155;
    public const SERVICE_NUMBER_7255 = 7255;
    public const SERVICE_NUMBER_7355 = 7355;
    public const SERVICE_NUMBER_7455 = 7455;
    public const SERVICE_NUMBER_7555 = 7555;
    public const SERVICE_NUMBER_7636 = 7636;
    public const SERVICE_NUMBER_77464 = 77464;
    public const SERVICE_NUMBER_78464 = 78464;
    public const SERVICE_NUMBER_7936 = 7936;
    public const SERVICE_NUMBER_91055 = 91055;
    public const SERVICE_NUMBER_91155 = 91155;
    public const SERVICE_NUMBER_91455 = 91455;
    public const SERVICE_NUMBER_91664 = 91664;
    public const SERVICE_NUMBER_91955 = 91955;
    public const SERVICE_NUMBER_92055 = 92055;
    public const SERVICE_NUMBER_92555 = 92555;

    public int $value;

    private function __construct(int $serviceNumber)
    {
        if (!\in_array($serviceNumber, [
            self::SERVICE_NUMBER_7055,
            self::SERVICE_NUMBER_7155,
            self::SERVICE_NUMBER_7255,
            self::SERVICE_NUMBER_7355,
            self::SERVICE_NUMBER_7455,
            self::SERVICE_NUMBER_7555,
            self::SERVICE_NUMBER_7636,
            self::SERVICE_NUMBER_77464,
            self::SERVICE_NUMBER_78464,
            self::SERVICE_NUMBER_7936,
            self::SERVICE_NUMBER_91055,
            self::SERVICE_NUMBER_91155,
            self::SERVICE_NUMBER_91455,
            self::SERVICE_NUMBER_91664,
            self::SERVICE_NUMBER_91955,
            self::SERVICE_NUMBER_92055,
            self::SERVICE_NUMBER_92555,
        ], true)) {
            throw new \InvalidArgumentException('Invalid service number');
        }

        $this->value = $serviceNumber;
    }

    public static function create(int $serviceNumber): self
    {
        return new self($serviceNumber);
    }

    public static function createServiceNumber7055(): self
    {
        return new self(self::SERVICE_NUMBER_7055);
    }

    public static function createServiceNumber7155(): self
    {
        return new self(self::SERVICE_NUMBER_7155);
    }

    public static function createServiceNumber7255(): self
    {
        return new self(self::SERVICE_NUMBER_7255);
    }

    public static function createServiceNumber7355(): self
    {
        return new self(self::SERVICE_NUMBER_7355);
    }

    public static function createServiceNumber7455(): self
    {
        return new self(self::SERVICE_NUMBER_7455);
    }

    public static function createServiceNumber7555(): self
    {
        return new self(self::SERVICE_NUMBER_7555);
    }

    public static function createServiceNumber7636(): self
    {
        return new self(self::SERVICE_NUMBER_7636);
    }

    public static function createServiceNumber77464(): self
    {
        return new self(self::SERVICE_NUMBER_77464);
    }

    public static function createServiceNumber78464(): self
    {
        return new self(self::SERVICE_NUMBER_78464);
    }

    public static function createServiceNumber7936(): self
    {
        return new self(self::SERVICE_NUMBER_7936);
    }

    public static function createServiceNumber91055(): self
    {
        return new self(self::SERVICE_NUMBER_91055);
    }

    public static function createServiceNumber91155(): self
    {
        return new self(self::SERVICE_NUMBER_91155);
    }

    public static function createServiceNumber91455(): self
    {
        return new self(self::SERVICE_NUMBER_91455);
    }

    public static function createServiceNumber91664(): self
    {
        return new self(self::SERVICE_NUMBER_91664);
    }

    public static function createServiceNumber91955(): self
    {
        return new self(self::SERVICE_NUMBER_91955);
    }

    public static function createServiceNumber92055(): self
    {
        return new self(self::SERVICE_NUMBER_92055);
    }

    public static function createServiceNumber92555(): self
    {
        return new self(self::SERVICE_NUMBER_92555);
    }

    public function toArray(): array
    {
        return [
            'number' => $this->value,
        ];
    }
}
