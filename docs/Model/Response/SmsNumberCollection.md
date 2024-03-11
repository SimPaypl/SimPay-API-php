# Simpay\Model\Response\SmsNumberCollection

The `Simpay\Model\Response\SmsNumberCollection` class represents a collection of SMS numbers.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$data` | array | An array of `SmsNumber` objects |
| `$pagination` | Pagination | The pagination information for the collection |

## Methods

### `__construct`

```php
public function __construct(
    array $data,
    Pagination $pagination
)
```

This method is the constructor of the `Simpay\Model\Response\SmsNumberCollection` class. It takes in two parameters:

* `$data` - An array of `SmsNumber` objects
* `$pagination` - The pagination information for the collection (Pagination object)

It sets the properties to their respective parameter values.

## Example

```php
$responseData = [
    'data' => [
        [
            'number' => '12345',
            'value' => 10.00,
            'value_net' => 8.94,
            'adult' => false
        ],
        [
            'number' => '67890',
            'value' => 20.00,
            'value_net' => 17.88,
            'adult' => true
        ]
    ],
    'pagination' => [
        'page' => 2,
        'per_page' => 10,
        'total' => 20,
        'last_page' => 2
    ]
];

$smsNumbers = [];
foreach ($responseData['data'] as $smsNumberData) {
    $smsNumbers[] = SmsNumber::createFromResponse($smsNumberData);
}

$pagination = Pagination::createFromResponse($responseData['pagination']);

$smsNumberCollection = new SmsNumberCollection($smsNumbers, $pagination);

echo count($smsNumberCollection->data); // 2
echo $smsNumberCollection->pagination->total; // 20
```