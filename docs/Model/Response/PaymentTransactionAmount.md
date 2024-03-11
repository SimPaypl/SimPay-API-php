# Simpay\Model\Response\PaymentTransactionAmount

The `Simpay\Model\Response\PaymentTransactionAmount` class represents an object that contains information about a payment transaction amount.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$value` | float | The transaction amount |
| `$currency` | string | The currency of the transaction amount |
| `$commission` | float | The commission for the transaction |

## Methods

### `__construct`

```php
private function __construct(float $value, string $currency, float $commission)
```

This method is the private constructor of the `Simpay\Model\Response\PaymentTransactionAmount` class. It takes in three parameters:

* `$value` - The transaction amount (float)
* `$currency` - The currency of the transaction amount (string)
* `$commission` - The commission for the transaction (float)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\PaymentTransactionAmount` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the amount properties. It returns a new instance of the `Simpay\Model\Response\PaymentTransactionAmount` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'value' => 10.00,
    'currency' => 'PLN',
    '