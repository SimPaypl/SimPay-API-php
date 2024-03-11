# Class: SmsCode

This class is used to represent an SMS code. It implements the RequestInterface and the Stringable interfaces.

## Properties

- `value`: a string representing the SMS code.

## Methods

### __construct

The constructor of the class receives a string representing the SMS code. It checks if the provided value is a string with 6 uppercase letters or digits, throwing an `InvalidArgumentException` if it is not. If the value is valid, it sets it to the `value` property.

### __toString

This method returns the string value of the SMS code.

### toArray

This method returns an array with the SMS code value, under the key `code`.

## Example

```php
$smsCode = new SmsCode('ABC123');
var_dump($smsCode->toArray());
// Output:
// array(1) {
//   ["code"]=>
//   string(6) "ABC123"
// }
```