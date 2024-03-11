<?php

declare(strict_types=1);

namespace Simpay;

use Simpay\Model\Request\ServiceId;
use Simpay\Model\Request\SmsNumber;

interface SmsNumbersInterface
{
    public function smsServiceNumbersList(ServiceId $serviceId): Model\Response\SmsNumberCollection;
    public function smsServiceNumber(ServiceId $serviceId, SmsNumber $number): Model\Response\SmsNumber;
    public function smsNumbers(): Model\Response\SmsNumberCollection;
    public function smsNumber(SmsNumber $number): Model\Response\SmsNumber;
}
