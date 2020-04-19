<?php

namespace simpay;

use simpay\Components;

class SmsXml extends Components
{
    private $error = false;
    private $errorCode = 0;

    private $apiKey = '';
    
    protected $components = '';
    
    public function __construct($key)
    {
        $this->apiKey = $key;
        
        $this->components = new Components();
    }
    
    public function generateCode()
    {
        $charset = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
        $length = 6;
        
        $str = '';
        $count = strlen($charset);
        
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
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

        if (hash('sha256', $data['sms_id'] . $data['sms_text'] . $data['sms_from'] . $data['send_number'] . $data['send_time'] . $this->apiKey) != $data['sign']) {
            $this->setError(true, 3);
            
            return false;
        }
        
        $sms = new SMSLocal();
        
        $sms->parseSMS($data);
        
        return $sms;
    }

    private function clearText($text)
    {
        return iconv('utf-8', 'ascii//TRANSLIT', $text);
    }
    
    public function generateXml($text)
    {
        return
            '<?xml version="1.0" encoding="UTF-8"?>
				<sms-response>
					<sms-text>' . $this->clearText($text) . '</sms-text>
			</sms-response>';
    }
    
    public function isError()
    {
        return $this->error;
    }
    
    public function getErrorText()
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
    
    private function setError($state, $code)
    {
        $this->error = $state;
        $this->errorCode = $code;
    }
}

class SMSLocal
{
    private $id;
    private $from;
    private $number;
    private $text;
    private $time;
    
    private $smsType = 0;
    
    private $smsValue = 0.0;
    
    private $pieces;
    
    private $arrayCodes = array(
        array('7055', 0.25),
        array('7136', 0.5),
        array('7255', 1),
        array('7355', 1.5),
        array('7455', 2),
        array('7555', 2.5),
        array('7636', 3),
        array('77464', 3.5),
        array('78464', 4),
        array('7936', 4.5),
        array('91055', 5),
        array('91155', 5.5),
        array('91455', 7),
        array('91664', 8),
        array('91955', 9.5),
        array('92055', 10),
        array('92555', 12.5),
    );
    
    public function parseSMS($data)
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
    
    public function getType()
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
