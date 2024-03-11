<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Simpay\Configuration;
use Simpay\DirectBillingCalculateApi;
use Simpay\Model\Request\Amount;
use Simpay\Model\Request\ServiceId;

$configuration = new Configuration('your_api_key', 'your_api_password', 'en');
$factory = new Simpay\HttpClientFactory($configuration);
$api = new DirectBillingCalculateApi($factory);

try {
    // Fee calculation for a specific provider
    $serviceId = new ServiceId('d151e4f9');
    $serviceCalculation = $api->directBillingServiceCalculate($serviceId, new Amount(23.00));
    if (null !== $serviceCalculation->orange) {
        echo $serviceCalculation->orange->net . PHP_EOL;
        echo $serviceCalculation->orange->gross . PHP_EOL;
    }
    if (null !== $serviceCalculation->play) {
        echo $serviceCalculation->play->net . PHP_EOL;
        echo $serviceCalculation->play->gross . PHP_EOL;
    }
    if (null !== $serviceCalculation->tMobile) {
        echo $serviceCalculation->tMobile->net . PHP_EOL;
        echo $serviceCalculation->tMobile->gross . PHP_EOL;
    }
} catch (Simpay\Exception\Unauthorized $exception) {
    // Handle unauthorized exception
    \print_r($exception->getMessage());
} catch (Simpay\Exception\Forbidden $exception) {
    // Handle forbidden exception
    \print_r($exception->getMessage());
} catch (Simpay\Exception\NotFound $exception) {
    // Handle not found exception
    \print_r($exception->getMessage());
} catch (Simpay\Exception\UnprocessableEntity $exception) {
    // Handle unprocessable entity exception
    \print_r($exception->getMessage());
} catch (Simpay\Exception\InternalServerError $exception) {
    // Handle internal server error exception
    \print_r($exception->getMessage());
} catch (Simpay\Exception\Unknown $exception) {
    // Handle unknown exception
    \print_r($exception->getMessage());
}
