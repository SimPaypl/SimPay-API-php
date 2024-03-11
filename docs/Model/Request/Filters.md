## Class `Filters`

The `Filters` class implements the `RequestInterface` interface and represents a request model for filtering transactions. It contains three private properties `$status`, `$phoneNumber`, and `$control` which hold the filters for the transactions. The class also has a constructor that takes in three optional parameters and sets the values of the properties upon instantiation. The class has a `toArray()` method that returns an associative array representation of the `Filters` object.

### Constructor

#### `__construct(DirectBillingTransactionStatus $status = null, PhoneNumber $phoneNumber = null, Control $control = null): void`

The constructor takes in three optional parameters `$status`, `$phoneNumber`, and `$control` of types `DirectBillingTransactionStatus`, `PhoneNumber`, and `Control`, respectively. It sets the values of the `$status`, `$phoneNumber`, and `$control` properties to the values of these parameters if they are not null.

### Methods

#### `toArray(): array`

The `toArray()` method returns an associative array representation of the `Filters` object. The array has a single key `filter` which holds an associative array of the properties of the `Filters` object that are not null. The properties that are not null are added to the `filter` array using the `+` operator.

### Example Usage

```php
$status = new DirectBillingTransactionStatus('paid');
$phoneNumber = new PhoneNumber('123456');
$control = new Control('1234');

$filters = new Filters($status, $phoneNumber, $control);
$filtersArray = $filters->toArray();

print_r($filtersArray);
/*
Array
(
    [filter] => Array
        (
            [status] => paid
            [phone_number] => 123456
            [control] => 1234
        )

)
*/
```