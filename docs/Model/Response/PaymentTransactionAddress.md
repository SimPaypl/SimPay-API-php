# Simpay\Model\Response\PaymentTransactionAddress

The `Simpay\Model\Response\PaymentTransactionAddress` class represents an object that contains information about a payment transaction address.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$name` | string&#124;null | The name associated with the address |
| `$surname` | string&#124;null | The surname associated with the address |
| `$street` | string&#124;null | The street name associated with the address |
| `$building` | string&#124;null | The building number associated with the address |
| `$flat` | string&#124;null | The flat or apartment number associated with the address |
| `$city` | string&#124;null | The city associated with the address |
| `$region` | string&#124;null | The region or state associated with the address |
| `$postalCode` | string&#124;null | The postal code associated with the address |
| `$country` | string&#124;null | The country associated with the address |
| `$company` | string&#124;null | The company name associated with the address |

## Methods

### `__construct`

```php
private function __construct(
    ?string $name,
    ?string $surname,
    ?string $street,
    ?string $building,
    ?string $flat,
    ?string $city,
    ?string $region,
    ?string $postalCode,
    ?string $country,
    ?string $company
)
```

This method is the private constructor of the `Simpay\Model\Response\PaymentTransactionAddress` class. It takes in ten parameters, each of which corresponds to one of the address properties. It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\PaymentTransactionAddress` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the address properties. It returns a new instance of the `Simpay\Model\Response\PaymentTransactionAddress` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'name' => 'John',
    'surname' => 'Doe',
    'street' => 'Main Street',
    'building' => '123',
    'flat' => '4',
   