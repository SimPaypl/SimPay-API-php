# Simpay\Model\Response\AmountType

The `Simpay\Model\Response\AmountType` class represents an object that contains a string value.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$value` | string | The string value |

## Methods

### `__construct`

```php
public function __construct(string $value)
```

This method is the constructor of the `Simpay\Model\Response\AmountType` class. It takes in one parameter: `$value`, which is a string. It sets the property `$value` to the parameter value.

## Example

```php
$amountType = new AmountType('fixed');

echo $amountType->value; // fixed
```