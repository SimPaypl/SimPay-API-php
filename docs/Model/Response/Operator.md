# Simpay\Model\Response\Operator

The `Simpay\Model\Response\Operator` class represents an object that contains an operator value.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$value` | string | The operator value |

## Methods

### `__construct`

```php
public function __construct(string $operator)
```

This method is the constructor of the `Simpay\Model\Response\Operator` class. It takes in one parameter: `$operator`, which is a string. It sets the property `$value` to the parameter value.

### `__toString`

```php
public function __toString(): string
```

This method is a magic method that returns the string representation of the `Simpay\Model\Response\Operator` object. It returns the value of the `$value` property as a string.

## Example

```php
$operator = new Operator('Operator Name');

echo $operator; // Operator Name
```