## Class `Operator`

The `Operator` class implements the `RequestInterface` interface and represents a request model for an operator. It contains four constants `ORANGE`, `PLAY`, `T_MOBILE`, and `PLUS` which represent the values for the four different operators. It also has a private property `$value` which holds the value of the operator and a constructor that sets the value of `$value` upon instantiation. The class also has a `toArray()` method that returns an associative array representation of the `Operator` object.

### Constants

#### `ORANGE`

This constant represents the Orange operator.

#### `PLAY`

This constant represents the Play operator.

#### `T_MOBILE`

This constant represents the T-Mobile operator.

#### `PLUS`

This constant represents the Plus operator.

### Constructor

#### `__construct(string $value): void`

The constructor takes in a single parameter `$value` of type string. It validates if the string is one of the constants defined in the class and throws an `InvalidArgumentException` if it is not. If the string is valid, it sets the value to the `$value` property.

### Methods

#### `toArray(): array`

The `toArray()` method returns an associative array representation of the `Operator` object. The array has a single key `operator` which holds the value of the `$value` property.

### Example Usage

```php
$operator = new Operator(Operator::ORANGE);
$operatorArray = $operator->toArray();

print_r($operatorArray);
/*
Array
(
    [operator] => orange
)
*/
```