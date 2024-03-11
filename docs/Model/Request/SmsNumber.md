# SmsNumber Class

The `SmsNumber` class is a simple model class that implements the `Stringable` interface. It represents a phone number used for sending SMS.

## Usage

To use the `SmsNumber` class, you first need to instantiate it with a valid integer number. The constructor will throw an `InvalidArgumentException` if the number is not valid.

```php
use Simpay\Model\Request\SmsNumber;

// Instantiate an SmsNumber object with a valid integer number
$number = new SmsNumber(123456789);

// Output the phone number as a string
echo $number; // "123456789"
```

## Methods

### `__construct(int $number)`

Instantiates an `SmsNumber` object with a valid integer number.

**Parameters:**
- `$number` : int - The integer phone number.

### `__toString(): string`

Returns the phone number as a string.

**Returns:**
- string - The phone number as a string.

## Exceptions

### `InvalidArgumentException`

The `InvalidArgumentException` is thrown if the number passed to the constructor is not valid.

## Example

```php
use Simpay\Model\Request\SmsNumber;

try {
    // Instantiate an SmsNumber object with a valid integer number
    $number = new SmsNumber(123456789);

    // Output the phone number as a string
    echo $number; // "123456789"
} catch (\InvalidArgumentException $e) {
    // Handle the exception
    echo $e->getMessage();
}
```