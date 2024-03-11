# Simpay\Model\Response\ServiceCalculation

The `Simpay\Model\Response\ServiceCalculation` class represents an object that contains information about a service calculation.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$orange` | ServiceCalculationOperatorAmount&#124;null | The calculation for Orange operator |
| `$play` | ServiceCalculationOperatorAmount&#124;null | The calculation for Play operator |
| `$tMobile` | ServiceCalculationOperatorAmount&#124;null | The calculation for T-Mobile operator |
| `$plus` | ServiceCalculationOperatorAmount&#124;null | The calculation for Plus operator |

## Methods

### `__construct`

```php
private function __construct(
    ?ServiceCalculationOperatorAmount $orange,
    ?ServiceCalculationOperatorAmount $play,
    ?ServiceCalculationOperatorAmount $tMobile,
    ?ServiceCalculationOperatorAmount $plus
)
```

This method is the private constructor of the `Simpay\Model\Response\ServiceCalculation` class. It takes in four parameters:

* `$orange` - The calculation for Orange operator (ServiceCalculationOperatorAmount object or null)
* `$play` - The calculation for Play operator (ServiceCalculationOperatorAmount object or null)
* `$tMobile` - The calculation for T-Mobile operator (ServiceCalculationOperatorAmount object or null)
* `$plus` - The calculation for Plus operator (ServiceCalculationOperatorAmount object or null)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\ServiceCalculation` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the service calculation properties. It returns a new instance of the `Simpay\Model\Response\ServiceCalculation` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'orange' => [
        'gross' => 11.00,
        'net' => 8.94,
        'commission' => 2.06
    ],
    'play' => [
        'gross' => 11.00,
        'net' => 8.94,
        'commission' => 2.06
    ],
    't-mobile' => [
        'gross' => 11.00,
        'net' => 8.94,
        'commission' => 2.06
    ],
    'plus' => [
        'gross' => 11.00,
        'net' => 8.94,
        'commission' => 2.06
    ]
];

$serviceCalculation = ServiceCalculation::createFromResponse($responseData);

echo $serviceCalculation->orange->gross; // 11.00
echo $serviceCalculation->play->gross; // 11.00
echo $serviceCalculation->tMobile->gross; // 11.00
echo $serviceCalculation->plus->gross; // 11.00
```