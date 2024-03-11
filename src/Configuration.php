<?php

declare(strict_types=1);

namespace Simpay;

class Configuration
{
    public const API_BASE_URI = 'https://api.simpay.pl';
    public const VERSION = '2.1.1';

    private string $apiKey;
    private string $apiPassword;
    private string $lang;

    public function __construct(string $apiKey, string $apiPassword, string $lang = 'en')
    {
        $this->apiKey = $apiKey;
        $this->apiPassword = $apiPassword;
        $this->lang = $lang;
    }

    public function getAuthHeader(): array
    {
        return [
            'X-SIM-KEY' => $this->apiKey,
            'X-SIM-PASSWORD' => $this->apiPassword,
            'X-SIM-LANG' => $this->lang,
            'X-SIM-VERSION' => self::VERSION,
            'X-SIM-PLATFORM' => 'PHP',
        ];
    }
}
