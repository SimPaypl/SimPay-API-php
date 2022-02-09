<?php

namespace SimPay\API\Components\DirectBilling;

class GenerateResponse
{

    private object $data;

    public string $transactionId;
    public string $redirectUrl;

    public function __construct(object $data) {

        $this->data = $data;

        $this->transactionId = $data->transactionId;
        $this->redirectUrl = $data->redirectUrl;

    }

    public function getTransactionId() {
        return $this->data->transactionId;
    }

    public function getRedirectUrl() {
        return $this->data->redirectUrl;
    }

}