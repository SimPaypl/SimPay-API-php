# Simpay\Model\Response\ServiceCalculationOperatorAmount

The `Simpay\Model\Response\ServiceCalculationOperatorAmount` class represents an object that contains information about a service calculation for a specific operator.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$net` | float&#124;null | The net amount of the calculation |
| `$gross` | float&#124;null | The gross amount of the calculation |

## Methods

### `__construct`

```php
private function __construct(?float $net, ?float $gross)
```

This method is the private constructor of the `Simpay\Model\Response\ServiceCalculationOperatorAmount` class. It takes in two parameters:

* `$net` - The net amount of the calculation (float or null)
* `$gross` - The gross amount of the calculation (float or null)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\ServiceCalculationOperatorAmount` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the operator calculation properties. It returns a new instance of the `Simpay\Model\Response\ServiceCalculationOperatorAmount` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'net' => 8.94,
    'gross' => 11.00
];

$operatorAmount = ServiceCalculationOperatorAmount::createFromResponse($responseData);

echo $operatorAmount->net; // 8.94
echo $operatorAmount->gross; // 11.00
```