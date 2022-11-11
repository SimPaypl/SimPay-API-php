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

    private array $pieces;

    private array $arrayCodes = [
        ['7055', 0.25],
        ['7155', 0.5],
        ['7255', 1],
        ['7355', 1.5],
        ['7455', 2],
        ['7555', 2.5],
        ['7636', 3],
        ['77464', 3.5],
        ['78464', 4],
        ['7936', 4.5],
        ['91055', 5],
        ['91155', 5.5],
        ['91455', 7],
        ['91664', 8],
        ['91955', 9.5],
        ['92055', 10],
        ['92555', 12.5]
    ];

    public function __construct(array $data)
    {

        $this->id = $data['sms_id'];
        $this->from = $data['sms_from'];
        $this->number = $data['send_number'];
        $this->text = $data['sms_text'];
        $this->time = $data['send_time'];

        $this->pieces = explode('.', $this->text);

        if (count($this->pieces) != 3) {
            $this->smsType = 0;
        } else {
            $this->smsType = 1;
        }

        $this->smsValue = $this->getSmsValue($this->number);

        return $this;

    }

    private function getSmsValue($number)
    {
        for ($iPosition = 0; $iPosition < count($this->arrayCodes); $iPosition++) {
            if ($this->arrayCodes[$iPosition][0] == $number) {
                return $this->arrayCodes[$iPosition][1];
            }
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getType(): int
    {
        return $this->smsType;
    }

    public function getPieces()
    {
        return $this->pieces;
    }

    public function getValue()
    {
        return $this->smsValue;
    }

}