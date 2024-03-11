# Documentation

## Class: Control

This class is used to represent a control value in a request to Simpay API.

### Properties

#### `$value` *(string)*

This property holds the control value.

### Methods

#### `__construct(string $value)`

This method is used to create a new instance of the `Control` class.

##### Parameters

- `$value` *(string)*: The control value.

##### Exceptions

- Throws an `\InvalidArgumentException` if the `$value` is empty or 0.

#### `toArray(): array`

This method is used to return an array representation of the `Control` object.

##### Return Value

- Returns an array with a single key `control` and its value as `$value`.