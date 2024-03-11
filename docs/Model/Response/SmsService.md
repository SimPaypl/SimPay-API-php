# Simpay\Model\Response\SmsService

The `Simpay\Model\Response\SmsService` class represents an object that contains information about an SMS service.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$id` | string | The ID of the SMS service |
| `$type` | ServiceType | The type of the SMS service |
| `$status` | ServiceStatus | The status of the SMS service |
| `$name` | string | The name of the SMS service |
| `$prefix` | string | The prefix of the SMS service |
| `$suffix` | string | The suffix of the SMS service |
| `$description` | string&#124;null | The description of the SMS service |
| `$adult` | bool | Whether the SMS service is for adult content |
| `$createdAt` | DateTimeImmutable | The date and time the SMS service was created |

## Methods

### `__construct`

```php
private function __construct(
    string $id,
    ServiceType $type,
    ServiceStatus $status,
    string $name,
    string $prefix,
    string $suffix,
    ?string $description,
    bool $adult,
    \DateTimeImmutable $createdAt
)
```

This method is the private constructor of the `Simpay\Model\Response\SmsService` class. It takes in nine parameters:

* `$id` - The ID of the SMS service (string)
* `$type` - The type of the SMS service (ServiceType object)
* `$status` - The status of the SMS service (ServiceStatus object)
* `$name` - The name of the SMS service (string)
* `$prefix` - The prefix of the SMS service (string)
* `$suffix` - The suffix of the SMS service (string)
* `$description` - The description of the SMS service (string or null)
* `$adult` - Whether the SMS service is for adult content (bool)
* `$createdAt` - The date and time the SMS service was created (DateTimeImmutable object)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\SmsService` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the SMS service