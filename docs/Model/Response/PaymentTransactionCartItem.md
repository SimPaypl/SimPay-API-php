# Simpay\Model\Response\PaymentTransactionCartItem

The `Simpay\Model\Response\PaymentTransactionCartItem` class represents an object that contains information about a payment transaction cart item.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$name` | string | The name of the cart item |
| `$quantity` | int | The quantity of the cart item |
| `$price` | float | The price of the cart item |
| `$producer` | string | The producer of the cart item |
| `$category` | string | The category of the cart item |
| `$code` | string | The code of the cart item |

## Methods

### `__construct`

```php
private function __construct(
    string $name,
    int $quantity,
    float $price,
    string $producer,
    string $category,
    string $code
)
```

This method is the private constructor of the `Simpay\Model\Response\PaymentTransactionCartItem` class. It takes in six parameters:

* `$name` - The name of the cart item (string)
* `$quantity` - The quantity of the cart item (int)
* `$price` - The price of the cart item (float)
* `$producer` - The producer of the cart item (string)
* `$category` - The category of the cart item (string)
* `$code` - The code of the cart item (string)

It sets the properties to their respective parameter values.

### `createFromResponse`

```php
public static function createFromResponse(array $data): self
```

This method is a static factory method that creates an instance of the `Simpay\Model\Response\PaymentTransactionCartItem` class from an array of data. It takes in one parameter: `$data`, which is an array that contains the values for the cart item properties. It returns a new instance of the `Simpay\Model\Response\PaymentTransactionCartItem` class with the properties set to the corresponding values in `$data`.

## Example

```php
$responseData = [
    'name' => 'Example Product',
    'quantity' => 2,
    'price' => 10.00,
    'producer' => 'Example Producer',
    'category' => 'Example Category',
    'code' => 'ABC123'
];

$cartItem = PaymentTransactionCartItem::createFromResponse($responseData);

echo $cartItem->name; // Example Product
echo $cartItem->quantity; // 2
echo $cartItem->price; // 10.00
echo $cartItem->producer; // Example Producer
echo $cartItem->category; // Example Category
echo $cartItem->code; // ABC123
```