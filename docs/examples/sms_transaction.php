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
use Simpay\Model\Request\SmsTransactionId;

$configuration = new Configuration('your_api_key', 'your_api_password', 'en');

$factory = new Simpay\HttpClientFactory($configuration);
$api = new Simpay\SmsTransactionApi($factory);

try {
    // Get all SMS transactions for a service
    $serviceId = new ServiceId('d151e4f9');
    $transactions = $api->smsTransactionsList($serviceId);

    foreach ($transactions->data as $transaction) {
        echo $transaction->id . PHP_EOL;
        echo $transaction->code . PHP_EOL;
        echo $transaction->value . PHP_EOL;
        echo $transaction->used . PHP_EOL;
        echo $transaction->from . PHP_EOL;
        echo $transaction->sendNumber . PHP_EOL;
        echo $transaction->sendAt->format('Y-m-d H:i:s') . PHP_EOL;
    }

    // Get details of an SMS transaction for a service
    $serviceId = new ServiceId('d151e4f9');
    $transactionId = new SmsTransactionId(123456);
    $transaction = $api->smsTransactionsShow($serviceId, $transactionId);
    echo $transaction->id . PHP_EOL;
    echo $transaction->code . PHP_EOL;
    echo $transaction->value . PHP_EOL;
    echo $transaction->used . PHP_EOL;
    echo $transaction->from . PHP_EOL;
    echo $transaction->sendNumber . PHP_EOL;
    echo $transaction->sendAt->format('Y-m-d H:i:s') . PHP_EOL;
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
