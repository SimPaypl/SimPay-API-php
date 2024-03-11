# Simpay\Model\Response\PaymentServiceTransaction

The `Simpay\Model\Response\PaymentServiceTransaction` class represents an object that contains information about a payment service transaction.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$id` | string | The transaction ID |
| `$status` | PaymentServiceTransactionStatus | The transaction status |
| `$amount` | float | The transaction amount |
| `$control` | string | The control value associated with the transaction |
| `$channel` | string | The payment channel used for the transaction |
| `$paidAt` | DateTimeImmutable | The date and time the transaction was paid |
| `$createdAt` | DateTimeImmutable | The date and time the transaction was created |
| `$updatedAt` | DateTimeImmutable | The date and time the transaction was last updated |

## Methods

### `__construct`

```php
private function __construct(
    string $id,
    PaymentServiceTransactionStatus $status,
    float $amount,
    string $control,
    string $channel,
    \DateTimeImmutable $paidAt,
    \DateTimeImmutable $createdAt,
    \DateTimeImmutable $updatedAt
)
```

This method is the private constructor of the `Simpay\Model\Response\PaymentServiceTransaction` class. It takes in eight parameters:

* `$id` - The transaction ID (string)
* `$status` - The transaction status (PaymentServiceTransactionStatus object)
* `$amount` - The transaction amount (float)
* `$control` - The control value associated with the transaction (string)
* `$channel` - The payment channel used for the transaction (string)
* `$paidAt` - The date and time the transaction was paid (DateTimeImmutable object)
* `$createdAt` - The date and time the transaction was created (DateTimeImmutable object)
* `$updatedAt` - The date and time the transaction was last updated (DateTimeImmutable object)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\PaymentServiceTransaction` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the transaction properties. It returns a new instance of the `Simpay\Model\Response\PaymentServiceTransaction` class with the properties set to the corresponding values in `$data`.

## Example

```php
$response