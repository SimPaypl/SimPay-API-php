# Documentation

## Class: CallbackReturnUrl

This class is used to represent the callback return URLs in a request to Simpay API.

### Properties

#### `$success` *(string)*

This property holds the success URL.

#### `$failure` *(string)*

This property holds the failure URL.

### Methods

#### `__construct(string $success, string $failure)`

This method is used to create a new instance of the `CallbackReturnUrl` class.

##### Parameters

- `$success` *(string)*: The success URL.
- `$failure` *(string)*: The failure URL.

#### `toArray(): array`

This method is used to return an array representation of the `CallbackReturnUrl` object.

##### Return Value

- Returns an array with a single key `returns` and an array of all the callback return URL properties.