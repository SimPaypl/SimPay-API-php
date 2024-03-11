<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Simpay\Configuration;
use Simpay\Exception\Forbidden;
use Simpay\Exception\InternalServerError;
use Simpay\Exception\NotFound;
use Simpay\Exception\Unauthorized;
use Simpay\Exception\Unknown;
use Simpay\Exception\UnprocessableEntity;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Request\SmsNumber;
use Simpay\SmsNumberApi;

$configuration = new Configuration('your_api_key', 'your_api_password', 'en');
$factory = new Simpay\HttpClientFactory($configuration);

$api = new SmsNumberApi($factory);

try {
    // Get details of an SMS number
    $number = new SmsNumber(123_456_789);
    $smsNumber = $api->smsNumber($number);
    echo $smsNumber->number . PHP_EOL;
    echo $smsNumber->value . PHP_EOL;
    echo $smsNumber->adult . PHP_EOL;
    echo $smsNumber->valueNet . PHP_EOL;

    // Get all SMS numbers for a service
    $serviceId = new ServiceId('d151e4f9');
    $serviceNumbers = $api->smsServiceNumbersList($serviceId);

    foreach ($serviceNumbers->data as $number) {
        echo $number->number . PHP_EOL;
        echo $number->value . PHP_EOL;
        echo $number->adult . PHP_EOL;
        echo $number->valueNet . PHP_EOL;
    }

    // Get details of an SMS number for a service
    $serviceId = new ServiceId('d151e4f9');
    $number = new SmsNumber(123_456_789);
    $serviceNumber = $api->smsServiceNumber($serviceId, $number);
    echo $serviceNumber->number . PHP_EOL;
    echo $serviceNumber->value . PHP_EOL;
    echo $serviceNumber->adult . PHP_EOL;
    echo $serviceNumber->valueNet . PHP_EOL;

    // Get all SMS numbers
    $numbers = $api->smsNumbers();

    foreach ($numbers->data as $number) {
        echo $number->number . PHP_EOL;
        echo $number->value . PHP_EOL;
        echo $number->adult . PHP_EOL;
        echo $number->valueNet . PHP_EOL;
    }
} catch (Unauthorized $exception) {
    // Handle unauthorized exception
    echo $exception->getMessage() . PHP_EOL;
} catch (Forbidden $exception) {
    // Handle forbidden exception
    echo $exception->getMessage() . PHP_EOL;
} catch (NotFound $exception) {
    // Handle not found exception
    echo $exception->getMessage() . PHP_EOL;
} catch (UnprocessableEntity $exception) {
    // Handle unprocessable entity exception
    echo $exception->getMessage() . PHP_EOL;
} catch (InternalServerError $exception) {
    // Handle internal server error exception
    echo $exception->getMessage() . PHP_EOL;
} catch (Unknown $exception) {
    // Handle unknown exception
    echo $exception->getMessage() . PHP_EOL;
}
