# Simpay\Model\Response\PaginationLinks

The `Simpay\Model\Response\PaginationLinks` class represents an object that contains links associated with pagination.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$nextPage` | string&#124;null | The link to the next page |
| `$previousPage` | string&#124;null | The link to the previous page |

## Methods

### `__construct`

```php
private function __construct(?string $nextPage, ?string $previousPage)
```

This method is the private constructor of the `Simpay\Model\Response\PaginationLinks` class. It takes in two parameters: `$nextPage` and `$previousPage`, both of which are strings representing the links to the next and previous pages respectively. It sets the properties `$nextPage` and `$previousPage` to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $links): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\PaginationLinks` class from an array of data. It takes in one parameter: `$links`, which is an array that contains the values for the pagination links. It returns a new instance of the `Simpay\Model\Response\PaginationLinks` class with the properties set to the corresponding values in `$links`.

## Example

```php
$responseData = [
    'next_page' => 'https://example.com/next',
    'previous_page' => 'https://example.com/previous'
];

$paginationLinks = PaginationLinks::createFromResponse($responseData);

echo $paginationLinks->nextPage; // https://example.com/next
echo $paginationLinks->previousPage; // https://example.com/previous
```