# Documentation

## Class: AmountType

This class is used to represent the type of an amount value in a request to Simpay API.

### Properties

#### `$value` *(string)*

This property holds the type of amount value.

### Constants

#### `REQUIRED` *(string)*

This constant represents the type of amount value as required.

#### `NET` *(string)*

This constant represents the type of amount value as net.

#### `GROSS` *(string)*

This constant represents the type of amount value as gross.

### Methods

#### `__construct(string $type)`

This method is used to create a new instance of the `AmountType` class.

##### Parameters

- `$type` *(string)*: The type of amount value.

##### Exceptions

- Throws an `\InvalidArgumentException` if the `$type` is not one of the defined constants.

#### `createRequired(): self`

This static method is used to create a new instance of the `AmountType` class with the `REQUIRED` constant as its value.

##### Return Value

- Returns a new instance of the `AmountType` class with the `REQUIRED` constant as its value.

#### `createNet(): self`

This static method is used to create a new instance of the `AmountType` class with the `NET` constant as its value.

##### Return Value

- Returns a new instance of the `AmountType` class with the `NET` constant as its value.

#### `createGross(): self`

This static method is used to create a new instance of the `AmountType` class with the `GROSS` constant as its value.

##### Return Value

- Returns a new instance of the `AmountType` class with the `GROSS` constant as its value.

#### `toArray(): array`

This method is used to return an array representation of the `AmountType` object.

##### Return Value

- Returns an array with a single key `amount_type` and its value as `$value`.