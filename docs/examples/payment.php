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
use Simpay\Model\Request\Amount;
use Simpay\Model\Request\Billing;
use Simpay\Model\Request\CallbackReturnUrl;
use Simpay\Model\Request\CartItem;
use Simpay\Model\Request\Channel;
use Simpay\Model\Request\ChannelType;
use Simpay\Model\Request\CreatePayment;
use Simpay\Model\Request\Currency;
use Simpay\Model\Request\Customer;
use Simpay\Model\Request\Description;
use Simpay\Model\Request\DirectChannel;
use Simpay\Model\Request\PaymentTransactionId;
use Simpay\Model\Request\Referer;
use Simpay\Model\Request\ServiceId;
use Simpay\Model\Request\Shipping;
use Simpay\PaymentApi;

$configuration = new Configuration('your_api_key', 'your_api_password', 'en');
$factory = new Simpay\HttpClientFactory($configuration);
$paymentApi = new PaymentApi($factory);

try {
    // Get all payment services
    $services = $paymentApi->paymentGetServices();

    foreach ($services->data as $service) {
        echo $service->id . PHP_EOL;
        echo $service->name . PHP_EOL;
        echo $service->status . PHP_EOL;
        echo $service->createdAt->format('Y-m-d H:i:s') . PHP_EOL;
    }

    // Get a specific payment service
    $serviceId = new ServiceId('d151e4f9');
    $service = $paymentApi->paymentGetService($serviceId);

    echo $service->id . PHP_EOL;
    echo $service->name . PHP_EOL;
    echo $service->status . PHP_EOL;
    echo $service->createdAt->format('Y-m-d H:i:s') . PHP_EOL;

    // Get all transactions for a payment service
    $serviceId = new ServiceId('d151e4f9');
    $transactions = $paymentApi->paymentGetTransactions($serviceId);

    // Get all payment channels for a payment service
    $serviceId = new ServiceId('d151e4f9');
    $channels = $paymentApi->paymentGetChannels($serviceId);

    // Create a new payment transaction for a payment service
    $serviceId = new ServiceId('d151e4f9');
    $createPayment = new CreatePayment(
        new Amount(23.23),
        [new CartItem('cart item name', 1, 20.00, 'producer', 'category', 'code',), ],
        new ChannelType(true, true, true, true, true),
        Currency::createDefault(),
        new Description('Default description'),
        new Simpay\Model\Request\Control('Default control'),
        new Customer('Default customer', 'jhondoe@example.com'),
        new Billing(
            'billing name',
            'billing surname',
            'billing street',
            'billing building',
            'billing flat',
            'billing city',
            'billing region',
            'billing postcode',
            'billing country',
            'billing company',
        ),
        new Shipping(
            'shipping name',
            'shipping surname',
            'shipping street',
            'shipping building',
            'shipping flat',
            'shipping city',
            'shipping region',
            'shipping postcode',
            'shipping country',
            'shipping company',
        ),
        new CallbackReturnUrl('https://example.com/success', 'https://example.com/failure',),
        new DirectChannel('direct_channel'),
        [new Channel('channel_id')],
        new Referer('https://example.com'),
    );
    $payment = $paymentApi->paymentTransactionCreate($serviceId, $createPayment);
    echo $payment->transactionId . PHP_EOL;
    echo $payment->redirectUrl . PHP_EOL;

    // Get details of a payment transaction for a payment service
    $transactionId = new PaymentTransactionId('transaction-id');
    $payment = $paymentApi->paymentGetTransaction($serviceId, $transactionId);
    echo $payment->id . PHP_EOL;
    echo $payment->status . PHP_EOL;
    echo $payment->createdAt->format('Y-m-d H:i:s') . PHP_EOL;
    echo $payment->updatedAt->format('Y-m-d H:i:s') . PHP_EOL;
    echo $payment->control . PHP_EOL;
    echo $payment->channel . PHP_EOL;
    echo $payment->description . PHP_EOL;

    if (null !== $payment->cart) {
        foreach ($payment->cart as $item) {
            echo $item->name . PHP_EOL;
            echo $item->quantity . PHP_EOL;
            echo $item->price . PHP_EOL;
            echo $item->producer . PHP_EOL;
            echo $item->category . PHP_EOL;
            echo $item->code . PHP_EOL;
        }
    }
    echo $payment->customer->name . PHP_EOL;
    echo $payment->customer->email . PHP_EOL;
    echo $payment->billing->name . PHP_EOL;
    echo $payment->billing->surname . PHP_EOL;
    echo $payment->billing->street . PHP_EOL;
    echo $payment->billing->building . PHP_EOL;
    echo $payment->billing->flat . PHP_EOL;
    echo $payment->billing->city . PHP_EOL;
    echo $payment->billing->region . PHP_EOL;
    echo $payment->billing->postalCode . PHP_EOL;
    echo $payment->billing->country . PHP_EOL;
    echo $payment->billing->company . PHP_EOL;
    echo $payment->shipping->name . PHP_EOL;
    echo $payment->shipping->surname . PHP_EOL;
    echo $payment->shipping->street . PHP_EOL;
    echo $payment->shipping->building . PHP_EOL;
    echo $payment->shipping->flat . PHP_EOL;
    echo $payment->shipping->city . PHP_EOL;
    echo $payment->shipping->region . PHP_EOL;
    echo $payment->shipping->postalCode . PHP_EOL;
    echo $payment->shipping->country . PHP_EOL;
    echo $payment->shipping->company . PHP_EOL;
    echo $payment->amount->value . PHP_EOL;
    echo $payment->amount->currency . PHP_EOL;
    echo $payment->amount->commission . PHP_EOL;
    echo $payment->paidAt->format('Y-m-d H:i:s') . PHP_EOL;
    echo $payment->redirects->failure . PHP_EOL;
    echo $payment->redirects->success . PHP_EOL;
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
