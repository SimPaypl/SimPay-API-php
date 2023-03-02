<?php

namespace SimPay\API\Components\SmsXml;

class SmsParse
{
    private int $id;
    private string $from;
    private int $number;
    private string $text;
    private string $time;

    private int $smsType = 0;

    private float $smsValue = 0.0;

    /**
     * @var array<string>
     **/
    private array $pieces;

    /**
     * @var array<int,array{'number': string,'value': float}>
     **/
    private array $arrayCodes = [
        ['number' => '7055', 'value' => 0.25],
        ['number' => '7155', 'value' => 0.5],
        ['number' => '7255', 'value' => 1.0],
        ['number' => '7355', 'value' => 1.5],
        ['number' => '7455', 'value' => 2.0],
        ['number' => '7555', 'value' => 2.5],
        ['number' => '7636', 'value' => 3.0],
        ['number' => '77464', 'value' => 3.5],
        ['number' => '78464', 'value' => 4.0],
        ['number' => '7936', 'value' => 4.5],
        ['number' => '91055', 'value' => 5.0],
        ['number' => '91155', 'value' => 5.5],
        ['number' => '91455', 'value' => 7.0],
        ['number' => '91664', 'value' => 8.0],
        ['number' => '91955', 'value' => 9.5],
        ['number' => '92055', 'value' => 10.0],
        ['number' => '92555', 'value' => 12.5],
    ];

    /**
     * @param array{'sms_id': int,'sms_from': string,'send_number': int,'sms_text': string,'send_time': string} $data
     **/
    public function __construct(array $data)
    {
        $this->id = $data['sms_id'];
        $this->from = $data['sms_from'];
        $this->number = $data['send_number'];
        $this->text = $data['sms_text'];
        $this->time = $data['send_time'];

        $this->pieces = explode('.', $this->text);

        if (3 != count($this->pieces)) {
            $this->smsType = 0;
        } else {
            $this->smsType = 1;
        }

        $this->smsValue = $this->getSmsValue($this->number);
    }

    private function getSmsValue(int $number): float
    {
        for ($iPosition = 0; $iPosition < count($this->arrayCodes); ++$iPosition) {
            if ($this->arrayCodes[$iPosition]['number'] == $number) {
                return $this->arrayCodes[$iPosition]['value'];
            }
        }

        return 0.0;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getType(): int
    {
        return $this->smsType;
    }

    /**
     * @return array<string>
     **/
    public function getPieces(): array
    {
        return $this->pieces;
    }

    public function getValue(): float
    {
        return $this->smsValue;
    }
}
