# Simpay\Model\Response\CallbackReturnUrl

The `Simpay\Model\Response\CallbackReturnUrl` class represents an object that contains success and failure URLs.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$success` | string | The success URL |
| `$failure` | string | The failure URL |

## Methods

### `__construct`

```php
private function __construct(string $success, string $failure)
```

This method is the private constructor of the `Simpay\Model\Response\CallbackReturnUrl` class. It takes in two parameters: `$success` and `$failure`, both of which are strings. It sets the properties `$success` and `$failure` to their respective parameter values.

### `create`

```php
public static function create(string $success, string $failure): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\CallbackReturnUrl` class. It takes in two parameters: `$success` and `$failure`, both of which are strings representing the success and failure URLs. It returns a new instance of the `Simpay\Model\Response\CallbackReturnUrl` class with `$success` and `$failure` set to the corresponding values.

## Example

```php
$callbackReturnUrl = CallbackReturnUrl::create('https://example.com/success', 'https://example.com/failure');

echo $callbackReturnUrl->success; // https://example.com/success
echo $callbackReturnUrl->failure; // https://example.com/failure
```