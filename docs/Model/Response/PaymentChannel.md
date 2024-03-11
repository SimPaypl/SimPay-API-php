# Simpay\Model\Response\PaymentChannel

The `Simpay\Model\Response\PaymentChannel` class represents an object that contains information about a payment channel.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$id` | string | The payment channel ID |
| `$name` | string | The payment channel name |
| `$type` | string | The payment channel type |
| `$img` | string | The URL of the payment channel image |
| `$commission` | float | The commission for the payment channel |
| `$currencies` | array | An array of currencies supported by the payment channel |
| `$amount` | Amount | The minimum and maximum amounts allowed for the payment channel |

## Methods

### `__construct`

```php
private function __construct(
    string $id,
    string $name,
    string $type,
    string $img,
    float $commission,
    array $currencies,
    Amount $amount
)
```

This method is the private constructor of the `Simpay\Model\Response\PaymentChannel` class. It takes in seven parameters:

* `$id` - The payment channel ID (string)
* `$name` - The payment channel name (string)
* `$type` - The payment channel type (string)
* `$img` - The URL of the payment channel image (string)
* `$commission` - The commission for the payment channel (float)
* `$currencies` - An array of currencies supported by the payment channel (array)
* `$amount` - The minimum and maximum amounts allowed for the payment channel (Amount object)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\PaymentChannel` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the payment channel properties. It returns a new instance of the `Simpay\Model\Response\PaymentChannel` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'id' => 'abc123',
    'name' => 'Payment Channel',
    'type' => 'type',
    'img' => 'https://example.com/image.png',
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
];

$paymentChannel = PaymentChannel::createFromResponse($responseData);

echo $paymentChannel->id; // abc123
echo $paymentChannel->name; // Payment Channel
echo $paymentChannel->type; // type
echo $paymentChannel->img; // https://example.com/image.png
echo $paymentChannel->commission; // 0.50
print_r($paymentChannel->currencies); // Array ( [0] => PLN [1] => EUR [2] => USD )
echo $paymentChannel->amount->min; // 5.00
echo $paymentChannel->amount->max; // 100.00
```