# Simpay\Model\Request\PhoneNumber

The `Simpay\Model\Request\PhoneNumber` class is a request model used to represent a phone number.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$value` | string | The value of the phone number |

## Methods

### `__construct`

```php
public function __construct(string $value)
```

This method is the constructor of the `Simpay\Model\Request\PhoneNumber` class. It takes in one parameter:

* `$value` - A string representing the phone number.

If the value is empty or '0', an `InvalidArgumentException` will be thrown. Otherwise, it sets the `$value` property to the given parameter.

### `toArray`

```php
public function toArray(): array
```

This method converts the `PhoneNumber` object to an array that can be used in a request to the Simpay API. It returns an array with the phone number.

## Example

```php
$phoneNumber = new PhoneNumber('+48123456789');

$requestData = $phoneNumber->toArray();

// Result: ['phone_number' => '+48123456789']
```