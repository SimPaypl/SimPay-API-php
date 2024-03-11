# Simpay\Model\Response\ServiceType

The `Simpay\Model\Response\ServiceType` class represents the type of a service.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$value` | string | The value of the service type |

## Methods

### `__construct`

```php
private function __construct(string $type)
```

This method is the private constructor of the `Simpay\Model\Response\ServiceType` class. It takes in one parameter:

* `$type` - The value of the service type (string)

It sets the `$value` property to the corresponding parameter value.

### `create`

```php
public static function create(string $type): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\ServiceType` class. It takes in one parameter:

* `$type` - The value of the service type (string)

It returns a new instance of the `Simpay\Model\Response\ServiceType` class with the `$value` property set to the corresponding parameter value.

### `__toString`

```php
public function __toString(): string
```

This method is a magic method that returns the string representation of the `ServiceType` object. It returns the string value of the `$value` property.

## Example

```php
$type = ServiceType::create('top-up');

echo $type; // top-up
```