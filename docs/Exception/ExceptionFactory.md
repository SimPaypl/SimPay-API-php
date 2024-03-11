# Class: Simpay\Exception\ExceptionFactory

This class has one static method named `create` which is responsible for creating an instance of the appropriate exception class based on the HTTP status code of the GuzzleHttp exception passed to it.

## Method: create

```php
public static function create(RequestException $exception): \Exception
```

### Parameters
- `$exception` : An instance of GuzzleHttp\Exception\RequestException.

### Return Value
- An instance of \Exception.

### Exceptions
- Throws a JSON_THROW_ON_ERROR exception if an error occurs while decoding the JSON response body.

### Exceptions thrown by the method

- `JSON_THROW_ON_ERROR` : If an error occurs while decoding the JSON response body.

### Exceptions thrown by the class

- `Unauthorized` : If the HTTP status code is 401.
- `Forbidden` : If the HTTP status code is 403.
- `NotFound` : If the HTTP status code is 404.
- `UnprocessableEntity` : If the HTTP status code is 422.
- `InternalServerError` : If the HTTP status code is 500.
- `Unknown` : If the HTTP status code is anything else.

### Method Description
This method takes in an instance of `GuzzleHttp\Exception\RequestException` and decodes the error message from its response body. It then returns an instance of the appropriate exception class based on the HTTP status code of the `RequestException` passed to it.

If the HTTP status code is 401, it will return an instance of `Unauthorized` class, if it is 403, it will return an instance of `Forbidden` class, if it is 404, it will return an instance of `NotFound` class, if it is 422, it will return an instance of `UnprocessableEntity` class, if it is 500, it will return an instance of `InternalServerError` class.

If the HTTP status code is anything else, it will return an instance of `Unknown` class and pass the original `RequestException` object as a parameter.