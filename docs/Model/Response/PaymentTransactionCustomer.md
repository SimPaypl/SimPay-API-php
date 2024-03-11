# Simpay\Model\Response\PaymentTransactionCustomer

The `Simpay\Model\Response\PaymentTransactionCustomer` class represents an object that contains information about a payment transaction customer.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$name` | string&#124;null | The name of the customer |
| `$email` | string | The email address of the customer |

## Methods

### `__construct`

```php
private function __construct(?string $name, string $email)
```

This method is the private constructor of the `Simpay\Model\Response\PaymentTransactionCustomer` class. It takes in two parameters:

* `$name` - The name of the customer (string or null)
* `$email` - The email address of the customer (string)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\PaymentTransactionCustomer` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the customer properties. It returns a new instance of the `Simpay\Model\Response\PaymentTransactionCustomer` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'name' => 'John Doe',
    'email' => 'johndoe@example.com'
];

$customer = PaymentTransactionCustomer::createFromResponse($responseData);

echo $customer->name; // John Doe
echo $customer->email; // johndoe@example.com
```