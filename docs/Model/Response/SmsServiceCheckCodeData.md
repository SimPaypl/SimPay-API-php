# Simpay\Model\Response\SmsServiceCheckCodeData

The `Simpay\Model\Response\SmsServiceCheckCodeData` class represents an object that contains information about an SMS code check.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$used` | bool | Whether the SMS code has been used |
| `$code` | string | The SMS code |
| `$test` | bool | Whether the SMS code is for testing purposes |
| `$from` | int | The number the SMS code was sent from |
| `$number` | ServiceNumber | The service number |
| `$value` | float | The value of the SMS code |
| `$usedAt` | DateTimeInterface&#124;null | The date and time the SMS code was used |

## Methods

### `__construct`

```php
private function __construct(
    bool $used,
    string $code,
    bool $test,
    int $from,
    ServiceNumber $number,
    float $value,
    ?DateTimeInterface $usedAt = null
)
```

This method is the private constructor of the `Simpay\Model\Response\SmsServiceCheckCodeData` class. It takes in seven parameters:

* `$used` - Whether the SMS code has been used (bool)
* `$code` - The SMS code (string)
* `$test` - Whether the SMS code is for testing purposes (bool)
* `$from` - The number the SMS code was sent from (int)
* `$number` - The service number (ServiceNumber object)
* `$value` - The value of the SMS code (float)
* `$usedAt` - The date and time the SMS code was used (DateTimeInterface object or null)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\SmsServiceCheckCodeData` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the SMS code check properties. It returns a new instance of the `Simpay\Model\Response\SmsServiceCheckCodeData` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'used' => false,
    'code' => '12345',
    'test' => true,
    'from' => 67890,
    'number' => '12345',
    'value' => 10.00,
    'used_at' => '2022-08-01T11:00:00+00:00'
];

$smsServiceCheckCodeData = SmsServiceCheckCodeData::createFromResponse($responseData);

echo $smsServiceCheckCodeData->used; // false
echo $smsServiceCheckCodeData->code; // 12345
echo $smsServiceCheckCodeData->test; // true
echo $smsServiceCheckCodeData->from; // 67890
echo $smsServiceCheckCodeData->number; // 12345
echo $smsServiceCheckCodeData->value; // 10.00
echo $smsServiceCheckCodeData->usedAt->format('Y-m-d H:i:s'); // 2022-08-01 11:00:00
```