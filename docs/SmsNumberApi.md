# Simpay\SmsNumberApi

The `Simpay\SmsNumberApi` class implements the `Simpay\SmsNumbersInterface` and is used to interact with the Simpay SMS Numbers API.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$client` | ClientInterface | The HTTP client used to make requests to the API |

## Methods

### `__construct`

```php
public function __construct(HttpClientFactoryInterface $factory)
```

This method is the constructor of the `Simpay\SmsNumberApi` class. It takes in one parameter:

* `$factory` - An instance of the `Simpay\HttpClientFactoryInterface` interface used to create the HTTP client used to make requests to the API.

It sets the `$client` property to the client created by the factory.

### `smsServiceNumbersList`

```php
public function smsServiceNumbersList(ServiceId $serviceId): SmsNumberCollection
```

This method sends a GET request to the Simpay SMS Numbers API to retrieve a list of SMS numbers for a specific service. It takes in one parameter:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the SMS service to retrieve numbers for.

It returns a `Simpay\Model\Response\SmsNumberCollection` object.

### `smsServiceNumber`

```php
public function smsServiceNumber(ServiceId $serviceId, Model\Request\SmsNumber $number): Model\Response\SmsNumber
```

This method sends a GET request to the Simpay SMS Numbers API to retrieve a specific SMS number for a specific service. It takes in two parameters:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the SMS service to retrieve the number for.
* `$number` - An instance of the `Simpay\Model\Request\SmsNumber` class representing the SMS number to retrieve.

It returns a `Simpay\Model\Response\SmsNumber` object.

### `smsNumbers`

```php
public function smsNumbers(): SmsNumberCollection
```

This method sends a GET request to the Simpay SMS Numbers API to retrieve a list of all available SMS numbers. It returns a `Simpay\Model\Response\SmsNumberCollection` object.

### `smsNumber`

```php
public function smsNumber(Model\Request\SmsNumber $number): Model\Response\SmsNumber
```

This method sends a GET request to the Simpay SMS Numbers API to retrieve a specific SMS number. It takes in one parameter:

* `$number` - An instance of the `Simpay\Model\Request\SmsNumber` class representing the SMS number to retrieve.

It returns a `Simpay\Model\Response\SmsNumber` object.

## Example

```php
$httpFactory = new HttpClientFactory('https://api.simpay.pl', '123456', 'qwerty');
$smsNumberApi = new SmsNumberApi($httpFactory);

$serviceId = new ServiceId('abc123');
$smsNumbers = $smsNumberApi->smsServiceNumbersList($serviceId);

foreach ($smsNumbers->data as $smsNumber) {
    echo $smsNumber->number . PHP_EOL;
}

$smsNumber = $smsNumberApi->smsServiceNumber($serviceId, new Model\Request\SmsNumber('12345'));

echo $smsNumber->number;

$smsNumbers = $smsNumberApi->smsNumbers();

foreach ($smsNumbers->data as $smsNumber) {
    echo $smsNumber->number . PHP_EOL;
}

$smsNumber = $smsNumberApi->smsNumber(new Model\Request\SmsNumber('12345'));

echo $smsNumber->number;
```