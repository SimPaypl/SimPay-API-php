<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class SmsNumber
{
    public ServiceNumber $number;
    public float $value;
    /** Net value, the same as $value. */
    public float $valueNet;
    public float $valueGross;
    public bool $adult;

    private function __construct(ServiceNumber $number, float $value, float $valueGross, bool $adult)
    {
        $this->number = $number;
        $this->value = $value;
        $this->valueNet = $value;
        $this->valueGross = $valueGross;
        $this->adult = $adult;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(new ServiceNumber($data['number']), (float) $data['value'], (float) $data['value_gross'], $data['adult']);
    }
}
