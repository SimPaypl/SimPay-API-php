<?php

declare(strict_types=1);

namespace Simpay;

use GuzzleHttp\ClientInterface;

interface HttpClientFactoryInterface
{
    public function create(): ClientInterface;
}
