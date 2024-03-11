# Documentation

## Class: CartItem

This class is used to represent an item in a cart in a request to Simpay API.

### Properties

#### `$name` *(string)*

This property holds the name of the cart item.

#### `$quantity` *(int)*

This property holds the quantity of the cart item.

#### `$price` *(float)*

This property holds the price of the cart item.

#### `$producer` *(string)*

This property holds the producer of the cart item.

#### `$category` *(string)*

This property holds the category of the cart item.

#### `$code` *(string)*

This property holds the code of the cart item.

### Methods

#### `__construct(string $name, int $quantity, float $price, string $producer, string $category, string $code)`

This method is used to create a new instance of the `CartItem` class.

##### Parameters

- `$name` *(string)*: The name of the cart item.
- `$quantity` *(int)*: The quantity of the cart item.
- `$price` *(float)*: The price of the cart item.
- `$producer` *(string)*: The producer of the cart item.
- `$category` *(string)*: The category of the cart item.
- `$code` *(string)*: The code of the cart item.

#### `toArray(): array`

This method is used to return an array representation of the `CartItem` object.

##### Return Value

- Returns an array of all the cart item properties.