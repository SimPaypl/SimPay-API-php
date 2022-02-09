<?php

namespace SimPay\API;

class Authorization
{

    private string $apiKey;
    private string $apiPassword;
    private string $lang;

    public function __construct(string $apiKey, string $apiPassword, string $lang = 'en') {
        $this->apiKey = $apiKey;
        $this->apiPassword = $apiPassword;
        $this->lang = $lang;
    }

    public function getHeaders(): array {
        return [
            'X-SIM-KEY' => $this->apiKey,
            'X-SIM-PASSWORD' => $this->apiPassword,
            'X-SIM-LANG' => $this->lang
        ];
    }

}