<?php

namespace SimPay\API\DirectBilling;

use SimPay\API\Adapter\Guzzle;
use SimPay\API\Components\DirectBilling\GenerateResponse;

class Payment
{
    private Guzzle $guzzle;

    private string $serviceId;
    private string $hash;

    private string $amountType = 'net';

    private float $amount;

    private string $description;

    private string $control;

    private string $returnSuccess;
    private string $returnFailure;

    private string $phoneNumber;

    private string $steamID;

    private int $provider;

    private string $signature;

    public function __construct(Guzzle $guzzle, string $serviceId, string $hash)
    {
        $this->guzzle = $guzzle;
        $this->serviceId = $serviceId;
        $this->hash = $hash;
    }

    public function setDescription(string $description): Payment
    {
        $this->description = $description;

        return $this;
    }

    public function setAmountType(string $amountType): Payment
    {
        $this->amountType = $amountType;

        return $this;
    }

    public function setAmount(float $amount): Payment
    {
        $this->amount = $amount;

        return $this;
    }

    public function setControl(string $control): Payment
    {
        $this->control = $control;

        return $this;
    }

    public function setReturnSuccess(string $returnSuccess): Payment
    {
        $this->returnSuccess = $returnSuccess;

        return $this;
    }

    public function setReturnFailure(string $returnFailure): Payment
    {
        $this->returnFailure = $returnFailure;

        return $this;
    }

    public function setPhoneNumber(string $phoneNumber): Payment
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function setProvider(int $provider): Payment
    {
        $this->provider = $provider;

        return $this;
    }

    public function setSteamID(string $steamID): Payment
    {
        $this->steamID = $steamID;

        return $this;
    }

    /**
     * @return bool|GenerateResponse
     */
    public function make()
    {
        $this->signature();

        $data = [
            'amount' => $this->amount,
            'amountType' => $this->amountType,
        ];

        if (isset($this->description)) {
            $data['description'] = $this->description;
        }

        if (isset($this->control)) {
            $data['control'] = $this->control;
        }

        if (isset($this->returnSuccess)) {
            $data['returns']['success'] = $this->returnSuccess;
        }

        if (isset($this->returnFailure)) {
            $data['returns']['failure'] = $this->returnFailure;
        }

        if (isset($this->phoneNumber)) {
            $data['phoneNumber'] = $this->phoneNumber;
        }

        if (isset($this->provider)) {
            $data['provider'] = $this->provider;
        }

        if (isset($this->provider)) {
            $data['provider'] = $this->provider;
        }

        if (isset($this->steamID)) {
            $data['steamid'] = $this->steamID;
        }

        $data['signature'] = $this->signature;

        if (!$response = $this->guzzle->request('POST', '/directbilling/'.$this->serviceId.'/transactions', $data)) {
            return false;
        }

        return new GenerateResponse($response);
    }

    /**
     * @return string
     */
    private function signature()
    {
        $array = [];

        $array['amount'] = $this->amount;
        $array['amountType'] = $this->amountType ?? 'net';

        if (isset($this->description)) {
            $array['description'] = $this->description;
        }

        if (isset($this->control)) {
            $array['control'] = $this->control;
        }

        if (isset($this->returnSuccess)) {
            $array['success'] = $this->returnSuccess;
        }

        if (isset($this->returnFailure)) {
            $array['failure'] = $this->returnFailure;
        }

        if (isset($this->phoneNumber)) {
            $array['phoneNumber'] = $this->phoneNumber;
        }

        if (isset($this->provider)) {
            $array['provider'] = $this->provider;
        }

        if (isset($this->steamID)) {
            $array['steamid'] = $this->steamID;
        }

        $array['hashKey'] = $this->hash;

        $this->signature = hash('sha256', implode('|', $array));

        return $this->signature;
    }
}
