<?php

namespace simpay;

use simpay\Components;

class DirectbillingTransactions extends Components
{
    protected $requestOptions = [
        'serviceId' => null,
        'amount' => null,
        'amount_gross' => null,
        'amount_required' => null,
        'provider' => null,
        'control' => null,
        'failure' => null,
        'complete' => null,
        'sign' => null
    ];

    protected $apiKey = '';
    protected $apiSecret = '';

    protected $resultInstance = null;

    protected $debugMode = false;
    
    public function __construct()
    {
        $this->components = new Components();
    }

    public function setDebugMode($value)
    {
        $this->debugMode = (boolean)$value;
    }

    private function isDebugMode()
    {
        return !!$this->debugMode;
    }

    private function logDebugMode($err)
    {
        print_r($err);

        error_log($err);
    }

    public function setServiceID($id)
    {
        $this->requestOptions['serviceId'] = $id;
    }

    public function setAmount($amount)
    {
        $this->requestOptions['amount'] = $amount;

        $this->requestOptions['amount_gross'] = null;
        $this->requestOptions['amount_required'] = null;
    }

    public function setAmountGross($amount)
    {
        $this->requestOptions['amount'] = null;

        $this->requestOptions['amount_gross'] = $amount;
        $this->requestOptions['amount_required'] = null;
    }

    public function setAmountRequired($amount)
    {
        $this->requestOptions['amount'] = null;

        $this->requestOptions['amount_gross'] = null;
        $this->requestOptions['amount_required'] = $amount;
    }

    public function setProvider($provider)
    {
        $this->requestOptions['provider'] = $provider;
    }

    public function setControl($control)
    {
        $this->requestOptions['control'] = $control;
    }

    public function setFailureLink($link)
    {
        $this->requestOptions['failure'] = $link;
    }

    public function setCompleteLink($link)
    {
        $this->requestOptions['complete'] = $link;
    }

    public function setApiKey($key)
    {
        $this->apiKey = $key;
    }
    
    public function setApiSecret($secret)
    {
        $this->apiSecret = $secret;
    }

    protected function generateSign()
    {
        $hash = '';
        
        if ($this->requestOptions['amount']) {
            $hash = hash('sha256', $this->requestOptions['serviceId'] . $this->requestOptions['amount'] . $this->requestOptions['control'] . $this->apiKey);
        } elseif ($this->requestOptions['amount_gross']) {
            $hash = hash('sha256', $this->requestOptions['serviceId'] . $this->requestOptions['amount_gross'] . $this->requestOptions['control'] . $this->apiKey);
        } elseif ($this->requestOptions['amount_required']) {
            $hash = hash('sha256', $this->requestOptions['serviceId'] . $this->requestOptions['amount_required'] . $this->requestOptions['control'] . $this->apiKey);
        }

        return $hash;
    }

    public function getTransactionLink()
    {
        if (!isset($this->resultInstance->link)) {
            return false;
        }

        return $this->resultInstance->link;
    }

    public function getResults()
    {
        return $this->resultInstance;
    }

    public function generateTransaction()
    {

        $this->requestOptions['sign'] = $this->generateSign();
        
        try {
            $this->resultInstance = $this->components->request($this->requestOptions, "https://simpay.pl/db/api");
        } catch (Exception $err) {
            if ($this->isDebugMode()) {
                $this->logDebugMode($err);
            }
        }
        
        if ($this->resultInstance->status != 'success') {
            if ($this->isDebugMode()) {
                $this->logDebugMode($this->resultInstance->message);
            }
        }
    }
}
