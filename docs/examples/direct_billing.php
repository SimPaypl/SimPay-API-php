<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Simpay\Configuration;
use Simpay\DirectBillingApi;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Response\Service;

$configuration = new Configuration('your_api_key', 'your_api_password', 'en');
$client = new Simpay\HttpClientFactory($configuration);
$directBillingApi = new DirectBillingApi($client);

try {
    // Get all services
    $services = $directBillingApi->directBillingGetServices();

    /** @var Service $service */
    foreach ($services->data as $service) {
        echo $service->id . PHP_EOL;
        echo $service->name. PHP_EOL;
        echo $service->suffix . PHP_EOL;
        echo $service->status->value . PHP_EOL;
        echo $service->createdAt->format('Y-m-d H:i:s') . PHP_EOL;
    }
    // Get a specific service
    $serviceId = new ServiceId('service-id');
    $service = $directBillingApi->directBillingService($serviceId);
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
