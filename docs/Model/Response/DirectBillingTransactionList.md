# Simpay\Model\Response\DirectBillingTransactionList

The `Simpay\Model\Response\DirectBillingTransactionList` class represents an object that contains basic information about a direct billing transaction.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$id` | string | The transaction ID |
| `$status` | string | The transaction status |
| `$value` | float | The transaction value |
| `$valueNetto` | float | The net value of the transaction |
| `$operator` | string | The operator name associated with the transaction |
| `$createdAt` | DateTimeImmutable | The date and time the transaction was created |
| `$updatedAt` | DateTimeImmutable | The date and time the transaction was last updated |

## Methods

### `__construct`

```php
private function __construct(
    string $id,
    string $status,
    float $value,
    float $valueNetto,
    string $operator,
    \DateTimeImmutable $createdAt,
    \DateTimeImmutable $updatedAt
)
```

This method is the private constructor of the `Simpay\Model\Response\DirectBillingTransactionList` class. It takes in seven parameters:

* `$id` - The transaction ID (string)
* `$status` - The transaction status (string)
* `$value` - The transaction value (float)
* `$valueNetto` - The net value of the transaction (float)
* `$operator` - The operator name associated with the transaction (string)
* `$createdAt` - The date and time the transaction was created (DateTimeImmutable object)
* `$updatedAt` - The date and time the transaction was last updated (DateTimeImmutable object)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\DirectBillingTransactionList` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the transaction properties. It returns a new instance of the `Simpay\Model\Response\DirectBillingTransactionList` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'id' => 'abc123',
    'status' => 'completed',
    'value' => 10.00,
    'value_netto' => 8.00,
    'operator' => 'Operator Name',
    'created_at' => '2022-08-01T12:00:00+00:00',
    'updated_at' => '2022-08-01T12:30:00+00:00'
];

$transactionList = DirectBillingTransactionList::createFromResponse($responseData);

echo $transactionList->id; // abc123
echo $transactionList->status; // completed
echo $transactionList->value; // 10.00
echo $transactionList->valueNetto; // 8.00
echo $transactionList->operator; // Operator Name
echo $transactionList->createdAt->format('Y-m-d H:i:s'); // 2022-08-01 12:00:00
echo $transactionList->updatedAt->format('Y-m-d H:i:s'); // 2022-08-01 12:30:00
```