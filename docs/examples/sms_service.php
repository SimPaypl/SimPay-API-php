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
use Simpay\Model\Request\ServiceNumber;
use Simpay\Model\Request\SmsCode;

$configuration = new Configuration('your_api_key', 'your_api_password', 'en');
$factory = new Simpay\HttpClientFactory($configuration);

$api = new Simpay\SmsServiceApi($factory);

try {
    // Get all SMS services
    $services = $api->smsServiceList();

    foreach ($services->data as $service) {
        echo $service->id . PHP_EOL;
        echo $service->name . PHP_EOL;
        echo $service->description . PHP_EOL;
        echo $service->type . PHP_EOL;
        echo $service->status . PHP_EOL;
        echo $service->adult . PHP_EOL;
        echo $service->createdAt->format('Y-m-d H:i:s') . PHP_EOL;
    }

    // Get details of an SMS service
    $serviceId = new ServiceId('d151e4f9');
    $service = $api->smsServiceShow($serviceId);
    echo $service->id . PHP_EOL;
    echo $service->name . PHP_EOL;
    echo $service->description . PHP_EOL;
    echo $service->type . PHP_EOL;
    echo $service->status . PHP_EOL;
    echo $service->adult . PHP_EOL;
    echo $service->createdAt->format('Y-m-d H:i:s') . PHP_EOL;

    // Check an SMS code for a service
    $serviceId = new ServiceId('d151e4f9');
    $code = new SmsCode('123456');
    $serviceNumber = ServiceNumber::createServiceNumber7055();
    $checkData = $api->smsServiceCheckCode($serviceId, $code, $serviceNumber);
    echo $checkData->number . PHP_EOL;
    echo $checkData->value . PHP_EOL;
    echo $checkData->code . PHP_EOL;
    echo $checkData->test . PHP_EOL;
    echo $checkData->used . PHP_EOL;
    if (true === $checkData->used && null !== $checkData->usedAt) {
        echo $checkData->usedAt->format('Y-m-d H:i:s') . PHP_EOL;
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
