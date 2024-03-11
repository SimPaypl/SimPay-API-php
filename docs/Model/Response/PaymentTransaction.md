# Simpay\Model\Response\PaymentServiceTransactionStatus

The `Simpay\Model\Response\PaymentServiceTransactionStatus` class represents an object that contains a payment service transaction status.

## Constants

The `Simpay\Model\Response\PaymentServiceTransactionStatus` class defines the following constants:

* `NEW` - The transaction is new
* `CONFIRMED` - The transaction has been confirmed
* `GENERATED` - The transaction has been generated
* `PAID` - The transaction has been paid
* `FAILED` - The transaction has failed
* `EXPIRED` - The transaction has expired
* `CANCELED` - The transaction has been canceled

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$value` | string | The value of the transaction status |

## Methods

### `__construct`

```php
public function __construct(string $value)
```

This method is the constructor of the `Simpay\Model\Response\PaymentServiceTransactionStatus` class. It takes in one parameter: `$value`, which is a string representing the value of the transaction status. It sets the `$value` property to the parameter value.

## Example

```php
$status = new PaymentServiceTransactionStatus(PaymentServiceTransactionStatus::PAID);

echo $status->value; // transaction_paid
```