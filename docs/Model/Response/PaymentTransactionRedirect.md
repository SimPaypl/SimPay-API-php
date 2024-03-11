# Simpay\Model\Response\PaymentTransactionRedirect

The `Simpay\Model\Response\PaymentTransactionRedirect` class represents an object that contains information about the redirect URLs for a payment transaction.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$success` | string&#124;null | The URL to redirect to on successful payment |
| `$failure` | string&#124;null | The URL to redirect to on failed payment |

## Methods

### `__construct`

```php
private function __construct(?string $success, ?string $failure)
```

This method is the private constructor of the `Simpay\Model\Response\PaymentTransactionRedirect` class. It takes in two parameters:

* `$success` - The URL to redirect to on successful payment (string or null)
* `$failure` - The URL to redirect to on failed payment (string or null)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\PaymentTransactionRedirect` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the redirect properties. It returns a new instance of the `Simpay\Model\Response\PaymentTransactionRedirect` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'success' => 'https://example.com/success',
    'failure' => 'https://example.com/failure'
];

$redirects = PaymentTransactionRedirect::createFromResponse($responseData);

echo $redirects->success; // https://example.com/success
echo $redirects->failure; // https://example.com/failure
```