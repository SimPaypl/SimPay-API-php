# Simpay\Model\Response\SmsTransactionCollection

The `Simpay\Model\Response\SmsTransactionCollection` class represents a collection of SMS transactions.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$data` | array | An array of `SmsTransaction` objects |
| `$pagination` | Pagination | The pagination information for the collection |

## Methods

### `__construct`

```php
public function __construct(
    array $data,
    Pagination $pagination
)
```

This method is the constructor of the `Simpay\Model\Response\SmsTransactionCollection` class. It takes in two parameters:

* `$data` - An array of `SmsTransaction` objects
* `$pagination` - The pagination information for the collection (Pagination object)

It sets the properties to their respective parameter values.

## Example

```php
$responseData = [
    'data' => [
        [
            'id' => 'abc123',
            'number' => '12345',
            'service_id' => '123',
            'value' => 10.00,
            'value_net' => 8.94,
            'sms_code' => '12345',
            'test' => false,
            'adult' => false,
            'status' => 'success',
            'created_at' => '2022-08-01T11:00:00+00:00',
            'used_at' => null
        ],
        [
            'id' => 'def456',
            'number' => '67890',
            'service_id' => '456',
            'value' => 20.00,
            'value_net' => 17.88,
            'sms_code' => '67890',
            'test' => true,
            'adult' => true,
            'status' => 'failure',
            'created_at' => '2022-07-01T10:00:00+00:00',
            'used_at' => '2022-07-02T10:00:00+00:00'
        ]
    ],
    'pagination' => [
        'page' => 2,
        'per_page' => 10,
        'total' => 20,
        'last_page' => 2
    ]
];

$smsTransactions = [];
foreach ($responseData['data'] as $smsTransactionData) {
    $smsTransactions[] = SmsTransaction::createFromResponse($smsTransactionData);
}

$pagination = Pagination::createFromResponse($responseData['pagination']);

$smsTransactionCollection = new SmsTransactionCollection($smsTransactions, $pagination);

echo count($smsTransactionCollection->data); // 2
echo $smsTransactionCollection->pagination->total; // 20
```