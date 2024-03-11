# Simpay\SmsTransactionApi

The `Simpay\SmsTransactionApi` class implements the `Simpay\SmsTransactionInterface` and is used to interact with the Simpay SMS Transaction API.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$client` | ClientInterface | The HTTP client used to make requests to the API |

## Methods

### `__construct`

```php
public function __construct(HttpClientFactoryInterface $factory)
```

This method is the constructor of the `Simpay\SmsTransactionApi` class. It takes in one parameter:

* `$factory` - An instance of the `Simpay\HttpClientFactoryInterface` interface used to create the HTTP client used to make requests to the API.

It sets the `$client` property to the client created by the factory.

### `smsTransactionsList`

```php
public function smsTransactionsList(ServiceId $serviceId): SmsTransactionCollection
```

This method sends a GET request to the Simpay SMS Transaction API to retrieve a list of transactions for a specific SMS service. It takes in one parameter:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the SMS service to retrieve transactions for.

It returns a `Simpay\Model\Response\SmsTransactionCollection` object.

### `smsTransactionsShow`

```php
public function smsTransactionsShow(ServiceId $serviceId, SmsTransactionId $transactionId): SmsTransaction
```

This method sends a GET request to the Simpay SMS Transaction API to retrieve a specific transaction for a specific SMS service. It takes in two parameters:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the SMS service to retrieve the transaction for.
* `$transactionId` - An instance of the `Simpay\Model\Request\SmsTransactionId` class representing the ID of the SMS transaction to retrieve.

It returns a `Simpay\Model\Response\SmsTransaction` object.

## Example

```php
$httpFactory = new HttpClientFactory('https://api.simpay.pl', '123456', 'qwerty');
$smsTransactionApi = new SmsTransactionApi($httpFactory);

$serviceId = new ServiceId('abc123');
$transactions = $smsTransactionApi->smsTransactionsList($serviceId);

foreach ($transactions->data as $transaction) {
    echo $transaction->id . PHP_EOL;
}

$transaction = $smsTransactionApi->smsTransactionsShow($serviceId, new SmsTransactionId('def456'));

echo $transaction->id;
```