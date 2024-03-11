# Simpay\Model\Response\SmsNumber

The `Simpay\Model\Response\SmsNumber` class represents an object that contains information about an SMS number.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$number` | ServiceNumber | The service number |
| `$value` | float | The value of the SMS number |
| `$valueNet` | float | The net value of the SMS number |
| `$adult` | bool | Whether the SMS number is for adult content |

## Methods

### `__construct`

```php
private function __construct(ServiceNumber $number, float $value, float $valueNet, bool $adult)
```

This method is the private constructor of the `Simpay\Model\Response\SmsNumber` class. It takes in four parameters:

* `$number` - The service number (ServiceNumber object)
* `$value` - The value of the SMS number (float)
* `$valueNet` - The net value of the SMS number (float)
* `$adult` - Whether the SMS number is for adult content (bool)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\SmsNumber` class from an array of data