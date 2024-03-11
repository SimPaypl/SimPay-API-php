<?php

declare(strict_types=1);

namespace Simpay;

use Simpay\Model\Request\ServiceId;
use Simpay\Model\Request\SmsCode;
use Simpay\Model\Response\SmsServiceCheckCodeData;
use Simpay\Model\Response\SmsServiceCollection;

interface SmsServiceInterface
{
    public function smsServiceList(): SmsServiceCollection;

    public function smsServiceShow(ServiceId $serviceId): Model\Response\SmsService;

    public function smsServiceCheckCode(
        ServiceId $serviceId,
        SmsCode $code,
        Model\Request\ServiceNumber $serviceNumber
    ): SmsServiceCheckCodeData;
}
