# Class: ServiceNumber

This class is used to represent a service number. It implements the RequestInterface.

## Properties

- `value`: an integer representing the service number.

## Constants

The class has several constants that represent the valid service numbers:

- `SERVICE_NUMBER_7055`
- `SERVICE_NUMBER_7155`
- `SERVICE_NUMBER_7255`
- `SERVICE_NUMBER_7355`
- `SERVICE_NUMBER_7455`
- `SERVICE_NUMBER_7555`
- `SERVICE_NUMBER_7636`
- `SERVICE_NUMBER_77464`
- `SERVICE_NUMBER_78464`
- `SERVICE_NUMBER_7936`
- `SERVICE_NUMBER_91055`
- `SERVICE_NUMBER_91155`
- `SERVICE_NUMBER_91455`
- `SERVICE_NUMBER_91664`
- `SERVICE_NUMBER_91955`
- `SERVICE_NUMBER_92055`
- `SERVICE_NUMBER_92555`

## Methods

### __construct

The constructor of the class receives an integer representing the service number. It checks if the provided service number is valid, throwing an `InvalidArgumentException` if it is not.

### create

This method receives an integer representing the service number and returns a new instance of the `ServiceNumber` class.

### createServiceNumber...

These methods create a new instance of the `ServiceNumber` class with the respective service number. For example, `createServiceNumber7055` returns a new instance of the `ServiceNumber` class with the service number `SERVICE_NUMBER_7055`.

### toArray

This method returns an array with the service number value, under the key `number`.

## Example

```php
$serviceNumber = ServiceNumber::create(ServiceNumber::SERVICE_NUMBER_7255);
var_dump($serviceNumber->toArray());
// Output:
// array(1) {
//   ["number"]=>
//   int(7255)
// }
```