<?php

declare(strict_types=1);

namespace Simpay;

use Simpay\Model\Request\Amount;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Response\ServiceCalculation;

interface DirectBillingCalculateInterface
{
    public function directBillingServiceCalculate(ServiceId $serviceId, Amount $amount): ServiceCalculation;
}
