<?php

namespace SimPay\API\SmsXml;

use SimPay\API\Components\SmsXml\SmsParse;

class SmsXml
{

    private string $hashKey;

    private bool $error = false;
    private int $errorCode = 0;

    public function __construct(string $hashKey)
    {
        $this->hashKey = $hashKey;
    }

    public function generateCode(): string
    {

        $charset = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
        $length = 6;

        $str = '';
        $count = strlen($charset);

        while ($length--) {
            $str .= $charset[mt_rand(0, $count - 1)];
        }

        return $str;
    }

    public function parseSMS($data)
    {

        if (!isset($data['sms_id'])) {
            $this->setError(true, 1);
            return false;
        }

        if (!isset($data['sms_from'])) {
            $this->setError(true, 1);
            return false;
        }

        if (!isset($data['send_number'])) {
            $this->setError(true, 1);
            return false;
        }

        if (!isset($data['sms_text'])) {
            $this->setError(true, 1);
            return false;
        }

        if (!isset($data['send_time'])) {
            $this->setError(true, 1);
            return false;
        }

        if (!isset($data['sign'])) {
            $this->setError(true, 2);
            return false;
        }

        if (hash('sha256', $data['sms_id'] . $data['sms_text'] . $data['sms_from'] . $data['send_number'] . $data['send_time'] . $this->hashKey) != $data['sign']) {
            $this->setError(true, 3);
            return false;
        }

        return new SmsParse($data);
    }

    private function setError(bool $state, int $code)
    {
        $this->error = $state;
        $this->errorCode = $code;
    }

    public function isError(): bool
    {
        return $this->error;
    }

    public function getErrorText(): string
    {
        switch ($this->errorCode) {
            case 0:
                return 'No Error';
            case 1:
                return 'Missing Parameters';
            case 2:
                return 'No Sign Param';
            case 3:
                return 'Wrong Sign';
        }

        return '';
    }

    private function clearText($text)
    {
        return iconv('utf-8', 'ascii//TRANSLIT', $text);
    }

    public function generateXml($text): string
    {
        return
            '<?xml version="1.0" encoding="UTF-8"?>
				<sms-response>
					<sms-text>' . $this->clearText($text) . '</sms-text>
			</sms-response>';
    }
}
