# Simpay\Model\Response\ServiceNumber

The `Simpay\Model\Response\ServiceNumber` class represents a service number.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$value` | int | The value of the service number |

## Methods

### `__construct`

```php
public function __construct(int $serviceNumber)
```

This method is the constructor of the `Simpay\Model\Response\ServiceNumber` class. It takes in one parameter:

* `$serviceNumber` - The value of the service number (int)

It sets the `$value` property to the corresponding parameter value.

### `__toString`

```php
public function __toString(): string
```

This method is a magic method that returns the string representation of the `ServiceNumber` object. It returns the string value of the `$value` property.

## Example

```php
$serviceNumber = new ServiceNumber(12345);

echo $serviceNumber; // 12345
```