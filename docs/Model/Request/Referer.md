# Simpay\Model\Request\Referer

The `Simpay\Model\Request\Referer` class is a request model used to represent a referer.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$value` | string | The value of the referer |

## Methods

### `__construct`

```php
public function __construct(string $referer)
```

This method is the constructor of the `Simpay\Model\Request\Referer` class. It takes in one parameter:

* `$referer` - A string representing the referer.

If the value is empty or '0', an `InvalidArgumentException` will be thrown. Otherwise, it sets the `$value` property to the given parameter.

### `toArray`

```php
public function toArray(): array
```

This method converts the `Referer` object to an array that can be used in a request to the Simpay API. It returns an array with the referer.

## Example

```php
$referer = new Referer('https://www.example.com/checkout');

$requestData = $referer->toArray();

// Result: ['referer' => 'https://www.example.com/checkout']
```