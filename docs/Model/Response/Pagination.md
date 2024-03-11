# Simpay\Model\Response\Pagination

The `Simpay\Model\Response\Pagination` class represents an object that contains pagination information.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$total` | int | The total number of items |
| `$count` | int | The number of items in the current page |
| `$perPage` | int | The number of items per page |
| `$currentPage` | int | The current page number |
| `$totalPages` | int | The total number of pages |
| `$links` | PaginationLinks&#124;null | The links associated with the pagination |

## Methods

### `__construct`

```php
private function __construct(
    int $total,
    int $count,
    int $perPage,
    int $currentPage,
    int $totalPages,
    ?PaginationLinks $links
)
```

This method is the private constructor of the `Simpay\Model\Response\Pagination` class. It takes in six parameters:

* `$total` - The total number of items (integer)
* `$count` - The number of items in the current page (integer)
* `$perPage` - The number of items per page (integer)
* `$currentPage` - The current page number (integer)
* `$totalPages` - The total number of pages (integer)
* `$links` - The links associated with the pagination (PaginationLinks object or null)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\Pagination` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the pagination properties. It returns a new instance of the `Simpay\Model\Response\Pagination` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
