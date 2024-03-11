# Documentation

## Class: Amount

This class is used to represent an amount value in a request to Simpay API.

### Properties

#### `$value` *(float)*

This property holds the amount value.

### Methods

#### `__construct(float $value)`

This method is used to create a new instance of the `Amount` class.

##### Parameters

- `$value` *(float)*: The amount value.

##### Exceptions

- Throws an `\InvalidArgumentException` if the `$value` is less than or equal to 0.

#### `toArray(): array`

This method is used to return an array representation of the `Amount` object.

##### Return Value

- Returns an array with a single key `amount` and its value as `$value`.