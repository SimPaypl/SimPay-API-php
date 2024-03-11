# Simpay\Model\Response\DirectBillingTransactionCollection

The `Simpay\Model\Response\DirectBillingTransactionCollection` class represents a collection of direct billing transactions.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$data` | array | An array of `DirectBillingTransactionList` objects |
| `$pagination` | Pagination | A `Pagination` object |

## Methods

### `__construct`

```php
public function __construct(
    array $data,
    Pagination $pagination
)
```

This method is the constructor of the `Simpay\Model\Response\DirectBillingTransactionCollection` class. It takes in two parameters:

* `$data` - An array of `DirectBillingTransactionList` objects
* `$pagination` - A `Pagination` object

It sets the properties to their respective parameter values.

## Example

```php
$responseData = [
    'data' => [
        [
            'id' => 'abc123',
            'status' => 'completed',
            'phone_number' => '123456789',
            'control' => 'xyz789',
            'value' => 10.00,
            'value_netto' => 8.00,
            'operator' => [
                'name' => 'Operator Name',
                'code' => '123'
            ],
            'notify' =>