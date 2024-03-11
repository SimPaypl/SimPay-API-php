# Simpay\Model\Response\PaymentServiceCollection

The `Simpay\Model\Response\PaymentServiceCollection` class represents a collection of payment services.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$data` | array | An array of `PaymentService` objects |
| `$pagination` | Pagination | A `Pagination` object |

## Methods

### `__construct`

```php
public function __construct(
    array $data,
    Pagination $pagination
)
```

This method is the constructor of the `Simpay\Model\Response\PaymentServiceCollection` class. It takes in two parameters:

* `$data` - An array of `PaymentService` objects
* `$pagination` - A `Pagination` object

It sets the properties to their respective parameter values.

## Example

```php
$responseData = [
    'data' => [
        [
            'id' => 'abc123',
            'name' => 'Payment Service 1',
            'status' => 'active',
            'created_at' => '2022-08-01T12:00:00+00:00'
        ],
        [
            'id' => 'def456',
            'name' => 'Payment Service 2',
            'status' => 'inactive',
            'created_at' => '2022-08-02T12:00:00+00:00'
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

$paymentServices = new PaymentServiceCollection(
    array_map([PaymentService::class, 'createFromResponse'], $responseData['data']),
    Pagination::createFromResponse($responseData['pagination'])
);

foreach ($paymentServices->data as $paymentService) {
    echo $paymentService->id;
}

echo $paymentServices->pagination->total; // 2
echo $paymentServices->pagination->perPage; // 10
echo $paymentServices->pagination->currentPage; // 1
echo $paymentServices->pagination->lastPage; // 1
echo $paymentServices->pagination->from; // 1
echo $paymentServices->pagination->to; // 2
```