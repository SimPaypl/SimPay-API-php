# Simpay\Model\Response\SmsServiceCollection

The `Simpay\Model\Response\SmsServiceCollection` class represents a collection of SMS services.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$data` | array | An array of `SmsService` objects |
| `$pagination` | Pagination | The pagination information for the collection |

## Methods

### `__construct`

```php
public function __construct(
    array $data,
    Pagination $pagination
)
```

This method is the constructor of the `Simpay\Model\Response\SmsServiceCollection` class. It takes in two parameters:

* `$data` - An array of `SmsService` objects
* `$pagination` - The pagination information for the collection (Pagination object)

It sets the properties to their respective parameter values.

## Example

```php
$responseData = [
    'data' => [
        [
            'id' => 'abc123',
            'type' => 'premium',
            'status' => 'active',
            'name' => 'Example SMS Service 1',
            'prefix' => '12345',
            'suffix' => 'example-sms-1',
            'description' => 'This is an example SMS service',
            'adult' => false,
            'created_at' => '2022-08-01T11:00:00+00:00'
        ],
        [
            'id' => 'def456',
            'type' => 'basic',
            'status' => 'inactive',
            'name' => 'Example SMS Service 2',
            'prefix' => '67890',
            'suffix' => 'example-sms-2',
            'description' => null,
            'adult' => true,
            'created_at' => '2022-07-01T10:00:00+00:00'
        ]
    ],
    'pagination' => [
        'page' => 2,
        'per_page' => 10,
        'total' => 20,
        'last_page' => 2
    ]
];

$smsServices = [];
foreach ($responseData['data'] as $smsServiceData) {
    $smsServices[] = SmsService::createFromResponse($smsServiceData);
}

$pagination = Pagination::createFromResponse($responseData['pagination']);

$smsServiceCollection = new SmsServiceCollection($smsServices, $pagination);

echo count($smsServiceCollection->data); // 2
echo $smsServiceCollection->pagination->total; // 20
```