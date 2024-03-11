# Simpay\SmsServiceApi

The `Simpay\SmsServiceApi` class implements the `Simpay\SmsServiceInterface` and is used to interact with the Simpay SMS Service API.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$client` | ClientInterface | The HTTP client used to make requests to the API |

## Methods

### `__construct`

```php
public function __construct(HttpClientFactoryInterface $factory)
```

This method is the constructor of the `Simpay\SmsServiceApi` class. It takes in one parameter:

* `$factory` - An instance of the `Simpay\HttpClientFactoryInterface` interface used to create the HTTP client used to make requests to the API.

It sets the `$client` property to the client created by the factory.

### `smsServiceList`

```php
public function smsServiceList(): SmsServiceCollection
```

This method sends a GET request to the Simpay SMS Service API to retrieve a list of all available SMS services. It returns a `Simpay\Model\Response\SmsServiceCollection` object.

### `smsServiceShow`

```php
public function smsServiceShow(ServiceId $serviceId): SmsService
```

This method sends a GET request to the Simpay SMS Service API to retrieve a specific SMS service. It takes in one parameter:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the SMS service to retrieve.

It returns a `Simpay\Model\Response\SmsService` object.

### `smsServiceCheckCode`

```php
public function smsServiceCheckCode(
    ServiceId $serviceId,
    SmsCode $code,
    ServiceNumber $serviceNumber
): SmsServiceCheckCodeData
```

This method sends a POST request to the Simpay SMS Service API to check a verification code for a specific SMS service and number. It takes in three parameters:

* `$serviceId` - An instance of the `Simpay\Model\Request\ServiceId` class representing the ID of the SMS service to check the code for.
* `$code` - An instance of the `Simpay\Model\Request\SmsCode` class representing the verification code to check.
* `$serviceNumber` - An instance of the `Simpay\Model\Request\ServiceNumber` class representing the phone number to check the verification code for.

It returns a `Simpay\Model\Response\SmsServiceCheckCodeData` object.

## Example

```php
$httpFactory = new HttpClientFactory('https://api.simpay.pl', '123456', 'qwerty');
$smsServiceApi = new SmsServiceApi($httpFactory);

$services = $smsServiceApi->smsServiceList();

foreach ($services->data as $service) {
    echo $service->name . PHP_EOL;
}

$service = $smsServiceApi->smsServiceShow(new ServiceId('abc123'));

echo $service->name;

$code = new SmsCode('123456');
$number = new ServiceNumber('+48123456789');

$checkCodeData = $smsServiceApi->smsServiceCheckCode(new ServiceId('abc123'), $code, $number);

echo $checkCodeData->status; // "OK"
```