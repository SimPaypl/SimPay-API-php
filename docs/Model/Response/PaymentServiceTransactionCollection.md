# Simpay\Model\Response\PaymentServiceTransactionCollection

The `Simpay\Model\Response\PaymentServiceTransactionCollection` class represents a collection of payment service transactions.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$data` | array | An array of `PaymentServiceTransaction` objects |
| `$pagination` | Pagination | A `Pagination` object |

## Methods

### `__construct`

```php
public function __construct(
    array $data,
    Pagination $pagination
)
```

This method is the constructor of the `Simpay\Model\Response\PaymentServiceTransactionCollection` class. It takes in two parameters:

* `$data` - An array of `PaymentServiceTransaction` objects
* `$pagination` - A `Pagination` object

It sets the properties to their respective parameter values.

## Example

```php
$responseData = [
    'data' => [
        [
            'id' => 'abc123',
            'status' => 'completed',
            'amount' => 10.00,
            'control' => 'control value',
            'channel' => 'Payment Channel',
            'paid_at' => '2022-08-01T12:00:00+00:00',
            'created_at' => '2022-08-01T11:00:00+00:00',
            'updated_at' => '2022-08-01T12:30:00+00:00'
        ],
        [
            'id' => 'def456',
            'status' => 'failed',
            'amount' => 5.00,
            'control' => 'control value 2',
            'channel' => 'Payment Channel 2',
            'paid_at' => '2022-08-02T12:00:00+00:00',
            'created_at' => '2022-08-02T11:00:00+00:00',
            'updated_at' => '2022-08-02T12:30:00+00:00'
        ]
    ],
    'pagination' => [
        'total' => 2,
        'per_page' => 10,
        'current_page' => 1,
        'last_page' => 1,
        'from' => 1,
        'to' => 2
    ]
];

$paymentServiceTransactions = new PaymentServiceTransactionCollection(
    array_map([PaymentServiceTransaction::class, 'createFromResponse'], $responseData['data']),
    Pagination::createFromResponse($responseData['pagination'])
);

foreach ($paymentServiceTransactions->data as $paymentServiceTransaction) {
    echo $paymentServiceTransaction->id;
}

echo $paymentServiceTransactions->pagination->total; // 2
echo $paymentServiceTransactions->pagination->perPage; // 10
echo $paymentServiceTransactions->pagination->currentPage; // 1
echo $paymentServiceTransactions->pagination->lastPage; // 1
echo $paymentServiceTransactions->pagination->from; // 1
echo $paymentServiceTransactions->pagination->to; // 2
```