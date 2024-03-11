# Simpay\Model\Response\PaymentCreate

The `Simpay\Model\Response\PaymentCreate` class represents an object that contains information about a created payment.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$transactionId` | string | The transaction ID |
| `$redirectUrl` | string | The redirect URL for the payment |

## Methods

### `__construct`

```php
public function __construct(string $transactionId, string $redirectUrl)
```

This method is the constructor of the `Simpay\Model\Response\PaymentCreate` class. It takes in two parameters:

* `$transactionId` - The transaction ID (string)
* `$redirectUrl` - The redirect URL for the payment (string)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\PaymentCreate` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the payment properties. It returns a new instance of the `Simpay\Model\Response\PaymentCreate` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'transaction_id' => 'abc123',
    'redirect_url' => 'https://example.com/redirect'
];

$paymentCreate = PaymentCreate::createFromResponse($responseData);

echo $paymentCreate->transactionId; // abc123
echo $paymentCreate->redirectUrl; // https://example.com/redirect
```