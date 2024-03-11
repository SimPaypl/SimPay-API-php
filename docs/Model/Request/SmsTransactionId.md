# SmsTransactionId Class

The `SmsTransactionId` class is a simple model class that implements the `Stringable` interface. It represents a transaction ID used for sending SMS.

## Usage

To use the `SmsTransactionId` class, you first need to instantiate it with a valid integer transaction ID. The constructor will throw an `InvalidArgumentException` if the transaction ID is not valid.

```php
use Simpay\Model\Request\SmsTransactionId;

// Instantiate an SmsTransactionId object with a valid integer transaction ID
$transactionId = new SmsTransactionId(123456789);

// Output the transaction ID as a string
echo $transactionId; // "123456789"
```

## Methods

### `__construct(int $value)`

Instantiates an `SmsTransactionId` object with a valid integer transaction ID.

**Parameters:**
- `$value` : int - The integer transaction ID.

### `__toString(): string`

Returns the transaction ID as a string.

**Returns:**
- string - The transaction ID as a string.

## Exceptions

### `InvalidArgumentException`

The `InvalidArgumentException` is thrown if the transaction ID passed to the constructor is not valid.

## Example

```php
use Simpay\Model\Request\SmsTransactionId;

try {
    // Instantiate an SmsTransactionId object with a valid integer transaction ID
    $transactionId = new SmsTransactionId(123456789);

    // Output the transaction ID as a string
    echo $transactionId; // "123456789"
} catch (\InvalidArgumentException $e) {
    // Handle the exception
    echo $e->getMessage();
}
```