# Simpay\PaymentApi

The `Simpay\PaymentApi` class implements the `Simpay\PaymentInterface` and is used to interact with the Simpay Payment API.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$client` | ClientInterface | The HTTP client used to make requests to the API |

## Methods

### `__construct`

```php
public function __construct(HttpClientFactoryInterface $factory)
```

This method is the constructor of the `Simpay\PaymentApi` class. It takes in one parameter:

* `$factory` - An instance of the `Simpay\HttpClientFactoryInterface` interface used to create the HTTP client used to make requests to the API.

It sets the `$client` property to the client created by the factory.

### `paymentGetServices`

```php
public function paymentGetServices(): PaymentServiceCollection
```

This method sends a GET request to the Simpay Payment API to retrieve a list of payment services. It returns a `Simpay\Model\Response\PaymentServiceCollection` object.

### `paymentGetService`

```php
public function paymentGetService(ServiceId $serviceId): PaymentService
```

This method sends a GET request to the Simpay Payment API to retrieve a specific payment service. It takes in one parameter:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the service to retrieve.

It returns a `Simpay\Model\Response\PaymentService` object.

### `paymentGetTransactions`

```php
public function paymentGetTransactions(ServiceId $serviceId): PaymentServiceTransactionCollection
```

This method sends a GET request to the Simpay Payment API to retrieve a list of transactions for a specific payment service. It takes in one parameter:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the payment service to retrieve transactions for.

It returns a `Simpay\Model\Response\PaymentServiceTransactionCollection` object.

### `paymentGetChannels`

```php
public function paymentGetChannels(ServiceId $serviceId): PaymentChannelCollection
```

This method sends a GET request to the Simpay Payment API to retrieve a list of payment channels for a specific payment service. It takes in one parameter:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the payment service to retrieve channels for.

It returns a `Simpay\Model\Response\PaymentChannelCollection` object.

### `paymentTransactionCreate`

```php
public function paymentTransactionCreate(ServiceId $serviceId, CreatePayment $request): PaymentCreate
```

This method sends a POST request to the Simpay Payment API to create a new payment transaction for a specific payment service. It takes in two parameters:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the payment service to create a transaction for.
* `$request` - An instance of the `Simpay\Model\Request\CreatePayment` class containing the details of the transaction to create.

It returns a `Simpay\Model\Response\PaymentCreate` object.

### `paymentGetTransaction`

```php
public function paymentGetTransaction(
    ServiceId $serviceId,
    PaymentTransactionId $transactionId
): PaymentTransaction
```

This method sends a GET request to the Simpay Payment API to retrieve a specific payment transaction for a specific payment service. It takes in two parameters:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the payment service to retrieve the transaction for.
* `$transactionId` - An instance of the `Simpay\Model\Request\PaymentTransactionId` class representing the ID of the payment transaction to retrieve.

It returns a `Simpay\Model\Response\PaymentTransaction` object.

## Example

```php
$httpFactory = new HttpClientFactory('https://api.simpay.pl', '123456', 'qwerty');
$paymentApi = new PaymentApi($httpFactory);

$services = $paymentApi->paymentGetServices();

foreach ($services->data as $service) {
    echo $service->name . PHP_EOL;
}

$service = $paymentApi->paymentGetService(new ServiceId('abc123'));

echo $service->name;

$transactions = $paymentApi->paymentGetTransactions(new ServiceId('abc123'));

foreach ($transactions->data as $transaction) {
    echo $transaction->id . PHP_EOL;
}

$channels = $paymentApi->paymentGetChannels(new ServiceId('abc123'));

foreach ($channels->data as $channel) {
    echo $channel->name . PHP_EOL;
}

$createPayment = new CreatePayment(
    new ServiceId('abc