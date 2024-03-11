## Class `ServiceId`

The `ServiceId` class implements the `Stringable` interface and represents a service ID. It has a single private property `$value` which holds the value of the service ID and a constructor that sets the value of `$value` upon instantiation. The class also has a `__toString()` method that returns the string representation of the `ServiceId` object.

### Constructor

#### `__construct(string $serviceId): void`

The constructor takes in a single parameter `$serviceId` of type string. It validates if the string is a valid 8-digit hexadecimal number and throws an `InvalidArgumentException` if it is not. If the string is valid, it sets the value to the `$value` property.

### Methods

#### `__toString(): string`

The `__toString()` method returns the string representation of the `ServiceId` object.

### Example Usage

```php
$serviceId = new ServiceId('12345678');
echo $serviceId;

// Output: 12345678
```