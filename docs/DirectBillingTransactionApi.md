# Simpay\DirectBillingTransactionApi

The `Simpay\DirectBillingTransactionApi` class implements the `Simpay\DirectBillingTransactionsInterface` and is used to interact with the Simpay Direct Billing Transactions API.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$client` | ClientInterface | The HTTP client used to make requests to the API |

## Methods

### `__construct`

```php
public function __construct(HttpClientFactoryInterface $factory)
```

This method is the constructor of the `Simpay\DirectBillingTransactionApi` class. It takes in one parameter:

* `$factory` - An instance of the `Simpay\HttpClientFactoryInterface` interface used to create the HTTP client used to make requests to the API.

It sets the `$client` property to the client created by the factory.

### `directBillingTransactions`

```php
public function directBillingTransactions(
    ServiceId $serviceId,
    Filters $filters = null
): DirectBillingTransactionCollection
```

This method sends a GET request to the Simpay Direct Billing Transactions API to retrieve a list of transactions for a specific service. It takes in two parameters:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the service to retrieve transactions for.
* `$filters` - An optional instance of the `Simpay\Model\Request\Filters` class representing filters to apply to the transactions.

It returns a `Simpay\Model\Response\DirectBillingTransactionCollection` object.

### `directBillingTransactionCreate`

```php
public function directBillingTransactionCreate(
    ServiceId $serviceId,
    DirectBillingTransaction $request
): DirectBillingTransactionCreate
```

This method sends a POST request to the Simpay Direct Billing Transactions API to create a new transaction for a specific service. It takes in two parameters:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the service to create a transaction for.
* `$request` - An instance of the `Simpay\Model\Request\DirectBillingTransaction` class containing the details of the transaction to create.

It returns a `Simpay\Model\Response\DirectBillingTransactionCreate` object.

### `directBillingTransaction`

```php
public function directBillingTransaction(
    ServiceId $serviceId,
    PaymentTransactionId $transactionId
): DirectBillingTransactionResponse
```

This method sends a GET request to the Simpay Direct Billing Transactions API to retrieve a specific transaction for a specific service. It takes in two parameters:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the service to retrieve the transaction for.
* `$transactionId` - An instance of the `Simpay\Model\Request\PaymentTransactionId` class representing the ID of the transaction to retrieve.

It returns a `Simpay\Model\Response\DirectBillingTransaction` object.

## Example

```php
$httpFactory = new HttpClientFactory('https://api.simpay.pl', '123456', 'qwerty');
$directBillingTransactionApi = new DirectBillingTransactionApi($httpFactory);

$serviceId = new ServiceId('abc123');
$filters = new Filters(1, 10);

$transactions = $directBillingTransactionApi->directBillingTransactions($serviceId, $filters);

foreach ($transactions->data as $transaction) {
    echo $transaction->id . PHP_EOL;
}

$transaction = $directBillingTransactionApi->directBillingTransaction(
    $serviceId,
    new PaymentTransactionId('def456'),
);

echo $transaction->id;
```