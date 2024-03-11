## Class `PaymentTransactionId`

The `PaymentTransactionId` class implements the `Stringable` interface and represents a payment transaction ID. It has a single private property `$value` which holds the value of the transaction ID and a constructor that sets the value of `$value` upon instantiation. The class also has a `__toString()` method that returns the string representation of the `PaymentTransactionId` object.

### Constructor

#### `__construct(string $transactionId): void`

The constructor takes in a single parameter `$transactionId` of type string. It validates if the string is a valid UUID (Universally Unique Identifier) and throws an `InvalidArgumentException` if it is not. If the string is valid, it sets the value to the `$value` property.

### Methods

#### `__toString(): string`

The `__toString()` method returns the string representation of the `PaymentTransactionId` object.

### Example Usage

```php
$transactionId = new PaymentTransactionId('123e4567-e89b-12d3-a456-426655440000');
echo $transactionId;

// Output: 123e4567-e89b-12d3-a456-426655440000
```