# Simpay\Model\Response\Service

The `Simpay\Model\Response\Service` class represents an object that contains information about a service.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$id` | string | The service ID |
| `$name` | string | The name of the service |
| `$suffix` | string | The service suffix |
| `$status` | ServiceStatus | The status of the service |
| `$createdAt` | DateTimeImmutable | The date and time the service was created |

## Methods

### `__construct`

```php
private function __construct(
    string $id,
    string $name,
    string $suffix,
    ServiceStatus $status,
    \DateTimeImmutable $createdAt
)
```

This method is the private constructor of the `Simpay\Model\Response\Service` class. It takes in five parameters:

* `$id` - The service ID (string)
* `$name` - The name of the service (string)
* `$suffix` - The service suffix (string)
* `$status` - The status of the service (ServiceStatus object)
* `$createdAt` - The date and time the service was created (DateTimeImmutable object)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\Service` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the service properties. It returns a new instance of the `Simpay\Model\Response\Service` class