# Class: Simpay\Exception\InternalServerError

This class extends the PHP built-in `Exception` class and represents an exception that is thrown when a HTTP 500 status code is returned from an API call.

## Properties
- `private const MESSAGE = 'Internal Server Error: %s';` : A constant string that represents the message format of the exception.

## Constructor
```php
private function __construct(string $message, \Throwable $previous = null)
```

### Parameters
- `$message` : A string that represents the error message.
- `$previous` : An instance of `\Throwable` that represents the previous exception.

### Return Value
- None.

### Exceptions thrown by the constructor
- None.

### Method Description
This constructor is private and is used to set the error message and status code of the `InternalServerError` exception. It takes in a string message and an optional `Throwable` object representing the previous exception. It calls the parent constructor of the `Exception` class and passes the formatted error message with the HTTP status code of 500 and the previous exception.

## Method: create

```php
public static function create(string $message, \Throwable $previous = null): self
```

### Parameters
- `$message` : A string that represents the error message.
- `$previous` : An instance of `\Throwable` that represents the previous exception.

### Return Value
- An instance of `self` (i.e. an instance of `Simpay\Exception\InternalServerError`).

### Exceptions thrown by the method
- None.

### Method Description
This method is a static factory method that is used to create and return an instance of the `InternalServerError` class. It takes in a string message and an optional `Throwable` object representing the previous exception. It then calls the private constructor of the class and passes the message and previous exception. It then returns a new instance of the `InternalServerError` class with the formatted error message.