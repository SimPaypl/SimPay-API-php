# Simpay\Model\Response\PaymentService

The `Simpay\Model\Response\PaymentService` class represents an object that contains information about a payment service.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$id` | string | The payment service ID |
| `$name` | string | The payment service name |
| `$status` | ServiceStatus | The payment service status |
| `$createdAt` | DateTimeImmutable | The date and time the payment service was created |

## Methods

### `__construct`

```php
private function __construct(
    string $id,
    string $name,
    ServiceStatus $status,
    \DateTimeImmutable $createdAt
)
```

This method is the private constructor of the `Simpay\Model\Response\PaymentService` class. It takes in four parameters:

* `$id` - The payment service ID (string)
* `$name` - The payment service name (string)
* `$status` - The payment service status (ServiceStatus object)
* `$createdAt` - The date and time the payment service was created (DateTimeImmutable object)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\PaymentService` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the payment service properties. It returns a new instance of the `Simpay\Model\Response\PaymentService` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'id' => 'abc123',
    'name' => 'Payment Service',
    'status' => 'active',
    'created_at' => '2022-08-01T12:00:00+00:00'
];

$paymentService = PaymentService::createFromResponse($responseData);

echo $paymentService->id; // abc123
echo $paymentService->name; // Payment Service
echo $paymentService->status->getValue(); // active
echo $paymentService->createdAt->format('Y-m-d H:i:s'); // 2022-08-01 12:00:00
```