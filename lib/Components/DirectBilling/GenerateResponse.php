<?php

namespace SimPay\API\Components\DirectBilling;

class GenerateResponse
{
    private object $data;

    public ?string $transactionId = null;
    public ?string $redirectUrl = null;

    public function __construct(object $data)
    {
        $this->data = $data;

        if (isset($data->transactionId)) {
            $this->transactionId = $data->transactionId;
        }

        if (isset($data->redirectUrl)) {
            $this->redirectUrl = $data->redirectUrl;
        }
    }

    public function getTransactionId(): ?string
    {
        if (!isset($this->data->transactionId)) {
            return null;
        }

        return $this->data->transactionId;
    }

    public function getRedirectUrl(): ?string
    {
        if (!isset($this->data->redirectUrl)) {
            return null;
        }

        return $this->data->redirectUrl;
    }
}
