## Class `DirectChannel`

The `DirectChannel` class implements the `RequestInterface` interface and represents a request model for a direct channel. It contains a single private property `$value` which holds the value of the direct channel and a constructor that sets the value of `$value` upon instantiation. The class also has a `toArray()` method that returns an array representation of the `DirectChannel` object.

### Constructor

#### `__construct(string $directChannel): void`

The constructor takes in a single parameter `$directChannel` of type string. It validates if the string is not empty or '0' and throws an `InvalidArgumentException` if it is. If the string is valid, it sets the value to the `$value` property.

### Methods

#### `toArray(): array`

The `toArray()` method returns an associative array representation of the `DirectChannel` object. The array has a single key `direct_channel` which holds the value of the `$value` property.

### Example Usage

```php
$directChannel = new DirectChannel('channel_1');
$directChannelArray = $directChannel->toArray();

print_r($directChannelArray);
/*
Array
(
    [direct_channel] => channel_1
)
*/
```