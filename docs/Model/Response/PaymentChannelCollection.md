# Simpay\Model\Response\PaymentChannelCollection

The `Simpay\Model\Response\PaymentChannelCollection` class represents a collection of payment channels.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$data` | array | An array of `PaymentChannel` objects |
| `$pagination` | Pagination | A `Pagination` object |

## Methods

### `__construct`

```php
public function __construct(
    array $data,
    Pagination $pagination
)
```

This method is the constructor of the `Simpay\Model\Response\PaymentChannelCollection` class. It takes in two parameters:

* `$data` - An array of `PaymentChannel` objects
* `$pagination` - A `Pagination` object

It sets the properties to their respective parameter values.

## Example

```php
$responseData = [
    'data' => [
        [
            'id' => 'abc123',
            'name' => 'Payment Channel 1',
            'type' => 'type',
            'img' => 'https://example.com/image1.png',
            'commission' => 0.50,
            'currencies' => [
                'PLN',
                'EUR',
                'USD'
            ],
            'amount' => [
                'min' => 5.00,
                'max' => 100.00
            ]
        ],
        [
            'id' => 'def456',
            'name' => 'Payment Channel 2',
            'type' => 'type',
            'img' => 'https://example.com/image2.png',
            'commission' => 1.00,
            'currencies' => [
                'PLN',
                'USD'
            ],
            'amount' => [
                'min' => 10.00,
                'max' => 500.00
            ]
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

$paymentChannels = new PaymentChannelCollection(
    array_map([PaymentChannel::class, 'createFromResponse'], $responseData['data']),
    Pagination::createFromResponse($responseData['pagination'])
);

foreach ($paymentChannels->data as $paymentChannel) {
    echo $paymentChannel->id;
}

echo $paymentChannels->pagination->total; // 2
echo $paymentChannels->pagination->perPage; // 10
echo $paymentChannels->pagination->currentPage; // 1
echo $paymentChannels->pagination->lastPage; // 1
echo $paymentChannels->pagination->from; // 1
echo $paymentChannels->pagination->to; // 2
```