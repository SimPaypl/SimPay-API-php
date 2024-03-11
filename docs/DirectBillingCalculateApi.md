# Simpay\DirectBillingCalculateApi

The `Simpay\DirectBillingCalculateApi` class implements the `Simpay\DirectBillingCalculateInterface` and is used to interact with the Simpay Direct Billing Calculate API.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$client` | ClientInterface | The HTTP client used to make requests to the API |

## Methods

### `__construct`

```php
public function __construct(HttpClientFactoryInterface $factory)
```

This method is the constructor of the `Simpay\DirectBillingCalculateApi` class. It takes in one parameter:

* `$factory` - An instance of the `Simpay\HttpClientFactoryInterface` interface used to create the HTTP client used to make requests to the API.

It sets the `$client` property to the client created by the factory.

### `directBillingServiceCalculate`

```php
public function directBillingServiceCalculate(ServiceId $serviceId, Amount $amount): ServiceCalculation
```

This method sends a GET request to the Simpay Direct Billing Calculate API to calculate the value of a given amount for a specific service. It takes in two parameters:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the service to calculate the value for.
* `$amount` - An instance of the `Simpay\Model\Request\Amount` class representing the amount to calculate the value for.

It returns a `Simpay\Model\Response\ServiceCalculation` object.

## Example

```php
$httpFactory = new HttpClientFactory('https://api.simpay.pl', '123456', 'qwerty');
$directBillingCalculateApi = new DirectBillingCalculateApi($httpFactory);

$serviceId = new ServiceId('abc123');
$amount = new Amount(10.00, 'PLN');

$serviceCalculation = $directBillingCalculateApi->directBillingServiceCalculate($serviceId, $amount);

echo $serviceCalculation->value; // 9.07
echo $serviceCalculation->valueGross; // 11.16
```