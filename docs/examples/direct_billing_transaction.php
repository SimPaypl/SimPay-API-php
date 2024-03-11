<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Simpay\Configuration;
use Simpay\DirectBillingTransactionApi;
use Simpay\Exception\Forbidden;
use Simpay\Exception\InternalServerError;
use Simpay\Exception\NotFound;
use Simpay\Exception\Unauthorized;
use Simpay\Exception\Unknown;
use Simpay\Exception\UnprocessableEntity;
use Simpay\Model\Request\Amount;
use Simpay\Model\Request\AmountType;
use Simpay\Model\Request\CallbackReturnUrl;
use Simpay\Model\Request\Control;
use Simpay\Model\Request\Description;
use Simpay\Model\Request\DirectBillingTransactionStatus;
use Simpay\Model\Request\Filters;
use Simpay\Model\Request\PaymentTransactionId;
use Simpay\Model\Request\PhoneNumber;
use Simpay\Model\Request\ServiceId;

$configuration = new Configuration('your_api_key', 'your_api_password', 'en');
$factory = new Simpay\HttpClientFactory($configuration);
$api = new DirectBillingTransactionApi($factory);

try {
    // GET list of transactions
    $serviceId = new ServiceId('d151e4f9');
    $filters = new Filters(
        DirectBillingTransactionStatus::new(),
        new PhoneNumber('1234567889'),
        new Control('test_control_filed_from_partner_service'),
    );
    $transactions = $api->directBillingTransactions($serviceId, $filters);

    foreach ($transactions->data as $transaction) {
        echo $transaction->id . PHP_EOL;
        echo $transaction->status . PHP_EOL;
        echo $transaction->value . PHP_EOL;
        echo $transaction->operator . PHP_EOL;
        echo $transaction->createdAt->format('Y-m-d H:i:s') . PHP_EOL;
        echo $transaction->updatedAt->format('Y-m-d H:i:s') . PHP_EOL;
    }

    // Get single transaction
    $serviceId = new ServiceId('d151e4f9');
    $transactionId = new PaymentTransactionId('dc261d4f-31ef-4728-bfd6-97bbe2a5ef0a');
    $transaction = $api->directBillingTransaction($serviceId, $transactionId);
    echo $transaction->id . PHP_EOL;
    echo $transaction->status . PHP_EOL;
    echo $transaction->phoneNumber . PHP_EOL;
    echo $transaction->control . PHP_EOL;
    echo $transaction->value . PHP_EOL;
    echo $transaction->valueNetto . PHP_EOL;

    // Create transaction
    $serviceId = new ServiceId('d151e4f9');
    $request = new Simpay\Model\Request\DirectBillingTransaction(
        new Amount(23.23),
        AmountType::createGross(),
        new Description('Default description'),
        new Control('96125f23-d549-4bfc-a845-b781b5f1ad03'),
        new CallbackReturnUrl('https://example.com/success', 'https://example.com/failed'),
        new PhoneNumber('43123456789'),
    );

    $transaction = $api->directBillingTransactionCreate($serviceId, $request);
    echo $transaction->transactionId . PHP_EOL;
    echo $transaction->redirectUrl . PHP_EOL;
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
