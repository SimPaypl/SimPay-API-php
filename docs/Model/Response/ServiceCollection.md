# Simpay\Model\Response\ServiceCollection

The `Simpay\Model\Response\ServiceCollection` class represents a collection of services.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$data` | array | An array of `Service` objects |
| `$pagination` | Pagination | The pagination information for the collection |

## Methods

### `__construct`

```php
public function __construct(
    array $data,
    Pagination $pagination
)
```

This method is the constructor of the `Simpay\Model\Response\ServiceCollection` class. It takes in two parameters:

* `$data` - An array of `Service` objects
* `$pagination` - The pagination information for the collection (Pagination object)

It sets the properties to their respective parameter values.

## Example

```php
$responseData = [
    'data' => [
        [
            'id' => 'abc123',
            'name' => 'Example Service 1',
            'suffix' => 'example-service-1',
            'status' => 'active',
            'created_at' => '2022-08-01T11:00:00+00:00'
        ],
        [
            'id' => 'def456',
            'name' => 'Example Service 2',
            'suffix' => 'example-service-2',
            'status' => 'inactive',
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

$services = [];
foreach ($responseData['data'] as $serviceData) {
    $services[] = Service::createFromResponse($serviceData);
}

$pagination = Pagination::createFromResponse($responseData['pagination']);

$serviceCollection = new ServiceCollection($services, $pagination);

echo count($serviceCollection->data); // 2
echo $serviceCollection->pagination->total; // 20
```