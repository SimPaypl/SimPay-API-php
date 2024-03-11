# Simpay\Model\Response\DirectBillingTransaction

The `Simpay\Model\Response\DirectBillingTransaction` class represents an object that contains information about a direct billing transaction.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$id` | string | The transaction ID |
| `$status` | string | The transaction status |
| `$phoneNumber` | string&#124;null | The phone number associated with the transaction |
| `$control` | string&#124;null | The control value associated with the transaction |
| `$value` | float | The transaction value |
| `$valueNetto` | float | The net value of the transaction |
| `$operator` | Operator&#124;null | The operator object associated with the transaction |
| `$notify` | DirectBillingTransactionNotify | The notify object associated with the transaction |
| `$createdAt` | DateTimeImmutable | The date and time the transaction was created |
| `$updatedAt` | DateTimeImmutable | The date and time the transaction was last updated |

## Methods

### `__construct`

```php
private function __construct(
    string $id,
    string $status,
    ?string $phoneNumber,
    ?string $control,
    float $value,
    float $valueNetto,
    ?Operator $operator,
    DirectBillingTransactionNotify $notify,
    \DateTimeImmutable $createdAt,
    \DateTimeImmutable $updatedAt
)
```

This method is the private constructor of the `Simpay\Model\Response\DirectBillingTransaction` class. It takes in ten parameters:

* `$id` - The transaction ID (string)
* `$status` - The transaction status (string)
* `$phoneNumber` - The phone number associated with the transaction (string or null)
* `$control` - The control value associated with the transaction (string or null)
* `$value` - The transaction value (float)
* `$valueNetto` - The net value of the transaction (float)
* `$operator` - The operator object associated with the transaction (Operator object or null)
* `$notify` - The notify object associated with the transaction (DirectBillingTransactionNotify object)
* `$createdAt` - The date and time the transaction was created (DateTimeImmutable object)
* `$updatedAt` - The date and time the transaction was last updated (DateTimeImmutable object)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\DirectBillingTransaction` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the transaction properties. It returns a new instance of the `Simpay\Model\Response\DirectBillingTransaction` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
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
    'notify' => [
        'url' => 'https://example.com/notify',
        'method' => 'post'
    ],
    'created_at' => '2022-08-01T12:00:00+00:00',
    'updated_at' => '2022-08-01T12:30:00+00:00'
];

$transaction = DirectBillingTransaction::createFromResponse($responseData);

echo $transaction->id; // abc123
echo $transaction->status; // completed
echo $transaction->phoneNumber; // 123456789
echo $transaction->control; // xyz789
echo $transaction->value; // 10.00
echo $transaction->valueNetto; // 8.00
echo $transaction->operator->name; // Operator Name
echo $transaction->operator->code; // 123
echo $transaction->notify->url; // https://example.com/notify
echo $transaction->notify->method; // post
echo $transaction->createdAt->format('Y-m-d H:i:s'); // 2022-08-01 12:00:00
echo $transaction->updatedAt->format('Y-m-d H:i:s'); // 2022-08-01 12:30:00
```