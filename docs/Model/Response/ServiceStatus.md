# Simpay\Model\Response\ServiceStatus

The `Simpay\Model\Response\ServiceStatus` class represents the status of a service.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$value` | string | The value of the service status |

## Methods

### `__construct`

```php
private function __construct(string $value)
```

This method is the private constructor of the `Simpay\Model\Response\ServiceStatus` class. It takes in one parameter:

* `$value` - The value of the service status (string)

It sets the `$value` property to the corresponding parameter value.

### `create`

```php
public static function create(string $value): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\ServiceStatus` class. It takes in one parameter:

* `$value` - The value of the service status (string)

It returns a new instance of the `Simpay\Model\Response\ServiceStatus` class with the `$value` property set to the corresponding parameter value.

### `__toString`

```php
public function __toString(): string
```

This method is a magic method that returns the string representation of the `ServiceStatus` object. It returns the string value of the `$value` property.

## Example

```php
$status = ServiceStatus::create('active');

echo $status; // active
```