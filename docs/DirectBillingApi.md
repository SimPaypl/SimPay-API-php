# Simpay\DirectBillingApi

The `Simpay\DirectBillingApi` class implements the `Simpay\DirectBillingInterface` and is used to interact with the Simpay Direct Billing API.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$client` | ClientInterface | The HTTP client used to make requests to the API |

## Methods

### `__construct`

```php
public function __construct(HttpClientFactoryInterface $factory)
```

This method is the constructor of the `Simpay\DirectBillingApi` class. It takes in one parameter:

* `$factory` - An instance of the `Simpay\HttpClientFactoryInterface` interface used to create the HTTP client used to make requests to the API.

It sets the `$client` property to the client created by the factory.

### `directBillingGetServices`

```php
public function directBillingGetServices(): ServiceCollection
```

This method sends a GET request to the Simpay Direct Billing API to retrieve a list of services. It returns a `Simpay\Model\Response\ServiceCollection` object.

### `directBillingService`

```php
public function directBillingService(ServiceId $serviceId): Service
```

This method sends a GET request to the Simpay Direct Billing API to retrieve a specific service. It takes in one parameter:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the service to retrieve.

It returns a `Simpay\Model\Response\Service` object.

## Example

```php
$httpFactory = new HttpClientFactory('https://api.simpay.pl', '123456', 'qwerty');
$directBillingApi = new DirectBillingApi($httpFactory);

$services = $directBillingApi->directBillingGetServices();

foreach ($services->data as $service) {
    echo $service->name . PHP_EOL;
}

$service = $directBillingApi->directBillingService(new ServiceId('abc123'));

echo $service->name;
```