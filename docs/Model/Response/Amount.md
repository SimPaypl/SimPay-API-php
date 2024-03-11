# Simpay\Model\Response\Amount

The `Simpay\Model\Response\Amount` class represents an object that contains minimum and maximum amount values.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$min` | float | The minimum amount value |
| `$max` | float | The maximum amount value |

## Methods

### `__construct`

```php
private function __construct(float $min, float $max)
```

This method is the private constructor of the `Simpay\Model\Response\Amount` class. It takes in two parameters: `$min` and `$max`, both of which are floats. It sets the properties `$min` and `$max` to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\Amount` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for `$min` and `$max`. It returns a new instance of the `Simpay\Model\Response\Amount` class with `$min` and `$max` set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'min' => 5.00,
    'max' => 100.00
];

$amount = Amount::createFromResponse($responseData);

echo $amount->min; // 5.00
echo $amount->max; // 100.00
```