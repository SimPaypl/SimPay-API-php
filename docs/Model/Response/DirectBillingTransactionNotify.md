# Simpay\Model\Response\DirectBillingTransactionNotify

The `Simpay\Model\Response\DirectBillingTransactionNotify` class represents an object that contains information about a direct billing transaction notification.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$isSend` | bool | A flag indicating whether the notification has been sent |
| `$lastSendAt` | DateTimeImmutable | The date and time the notification was last sent |
| `$count` | int | The number of times the notification has been sent |

## Methods

### `__construct`

```php
private function __construct(bool $isSend, \DateTimeImmutable $lastSendAt, int $count)
```

This method is the private constructor of the `Simpay\Model\Response\DirectBillingTransactionNotify` class. It takes in three parameters: `$isSend`, `$lastSendAt`, and `$count`, which are a boolean, a `DateTimeImmutable` object, and an integer respectively. It sets the properties `$isSend`, `$lastSendAt`, and `$count` to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\DirectBillingTransactionNotify` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the notification properties. It returns a new instance of the `Simpay\Model\Response\DirectBillingTransactionNotify` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'is_send' => true,
    'last_send_at' => '2022-08-01T12:00:00+00:00',
    'count' => 3
];

$transactionNotify = DirectBillingTransactionNotify::createFromResponse($responseData);

echo $transactionNotify->isSend; // true
echo $transactionNotify->lastSendAt->format('Y-m-d H:i:s'); // 2022-08-01 12:00:00
echo $transactionNotify->count; // 3
```