<?php

declare(strict_types=1);

namespace Simpay;

use Simpay\Model\Request\ServiceId;

interface DirectBillingInterface
{
    public function directBillingGetServices(): Model\Response\ServiceCollection;

    public function directBillingService(ServiceId $serviceId): Model\Response\Service;
}
