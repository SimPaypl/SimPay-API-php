# `SmsTransaction` class documentation

The `SmsTransaction` class represents an SMS transaction object. It contains the following properties:

- `$id`: an integer representing the ID of the SMS transaction.
- `$from`: an integer representing the number the SMS was sent from.
- `$code`: a string representing the code associated with the SMS transaction.
- `$used`: a boolean indicating whether the SMS transaction has been used.
- `$sendNumber`: a `ServiceNumber` object representing the service number associated with the SMS transaction.
- `$value`: a float representing the value of the SMS transaction.
- `$sendAt`: a `DateTimeImmutable` object representing the date and time the SMS was sent.

## Usage example

```php
use Simpay\Model\Response\SmsTransaction;

// Example response data
$responseData = [
    'id' => 123,
    'from' => 12345,
    'code' => 'ABC123',
    'used' => false,
    'send_number' => '67890',
    'value' => 10.0,
    'send_at' => '2022-01-01 12:00:00',
];

// Create SmsTransaction object from response data
$smsTransaction = SmsTransaction::createFromResponse($responseData);

// Access SmsTransaction properties
echo $smsTransaction->id; // Output: 123
echo $smsTransaction->from; // Output: 12345
echo $smsTransaction->code; // Output: 'ABC123'
echo $smsTransaction->used; // Output: false
echo $smsTransaction->sendNumber->value; // Output: '67890'
echo $smsTransaction->value; // Output: 10.0
echo $smsTransaction->sendAt->format('Y-m-d H:i:s'); // Output: '2022-01-01 12:00:00'
```

In the example above, we created a `SmsTransaction` object from response data and accessed its properties. To create a `SmsTransaction` object, you need to call the `createFromResponse` method and pass an array containing the SMS transaction data. The method will return a `SmsTransaction` object with the data from the array. Once you have a `SmsTransaction` object, you can access its properties using the object properties.