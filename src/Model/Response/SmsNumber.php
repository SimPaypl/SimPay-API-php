<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class SmsNumber
{
    public ServiceNumber $number;
    public float $value;
    public float $valueNet;
    public bool $adult;

    private function __construct(ServiceNumber $number, float $value, float $valueNet, bool $adult)
    {
        $this->number = $number;
        $this->value = $value;
        $this->valueNet = $valueNet;
        $this->adult = $adult;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(new ServiceNumber($data['number']), $data['value'], $data['value_net'], $data['adult']);
    }
}
