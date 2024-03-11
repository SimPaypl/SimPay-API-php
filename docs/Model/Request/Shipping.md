# Class: Shipping

This class is used to represent the shipping information of an order. It implements the RequestInterface.

## Properties

- `name`: a string representing the name of the person receiving the shipment.
- `surname`: a string representing the surname of the person receiving the shipment.
- `street`: a string representing the street address of the shipment.
- `building`: a string representing the building number of the shipment.
- `flat`: a string representing the flat number of the shipment.
- `city`: a string representing the city of the shipment.
- `region`: a string representing the region (e.g. state) of the shipment.
- `postalCode`: a string representing the postal code of the shipment.
- `country`: a string representing the country of the shipment.
- `company`: a string representing the name of the company receiving the shipment.

## Methods

### __construct

The constructor of the class receives the shipping information properties as parameters and sets them to the respective properties.

### toArray

This method returns an array with the shipping information, with the keys:

- `name`
- `surname`
- `street`
- `building`
- `flat`
- `city`
- `region`
- `postal_code`
- `country`
- `company`

## Example

```php
$shipping = new Shipping(
    'John',
    'Doe',
    'Main St.',
    '123',
    '7A',
    'New York',
    'NY',
    '10001',
    'US',
    'Acme Inc.'
);
var_dump($shipping->toArray());
// Output:
// array(1) {
//   ["shipping"]=>
//   array(10) {
//     ["name"]=>
//     string(4) "John"
//     ["surname"]=>
//     string(3) "Doe"
//     ["street"]=>
//     string(8) "Main St."
//     ["building"]=>
//     string(3) "123"
//     ["flat"]=>
//     string(2) "7A"
//     ["city"]=>
//     string(8) "New York"
//     ["region"]=>
//     string(2) "NY"
//     ["postal_code"]=>
//     string(5) "10001"
//     ["country"]=>
//     string(2) "US"
//     ["company"]=>
//     string(8) "Acme Inc."
//   }
// }
```