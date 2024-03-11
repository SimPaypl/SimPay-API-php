# Documentation

## Class: Channel

This class is used to represent a channel ID in a request to Simpay API.

### Properties

#### `$value` *(string)*

This property holds the channel ID.

### Methods

#### `__construct(string $value)`

This method is used to create a new instance of the `Channel` class.

##### Parameters

- `$value` *(string)*: The channel ID.

##### Exceptions

- Throws an `\InvalidArgumentException` if the `$value` is empty.

#### `__toString(): string`

This method is used to return the string representation of the `Channel` object.

##### Return Value

- Returns the channel ID.