# Documentation

## Class: Billing

This class is used to represent the billing information in a request to Simpay API.

### Properties

#### `$name` *(string)*

This property holds the name of the person or company that is being billed.

#### `$surname` *(string)*

This property holds the surname of the person or company that is being billed.

#### `$street` *(string)*

This property holds the street address of the person or company that is being billed.

#### `$building` *(string)*

This property holds the building number of the person or company that is being billed.

#### `$flat` *(string)*

This property holds the flat number of the person or company that is being billed.

#### `$city` *(string)*

This property holds the city of the person or company that is being billed.

#### `$region` *(string)*

This property holds the region of the person or company that is being billed.

#### `$postalCode` *(string)*

This property holds the postal code of the person or company that is being billed.

#### `$country` *(string)*

This property holds the country of the person or company that is being billed.

#### `$company` *(string)*

This property holds the name of the company that is being billed.

### Methods

#### `__construct(string $name, string $surname, string $street, string $building, string $flat, string $city, string $region, string $postalCode, string $country, string $company)`

This method is used to create a new instance of the `Billing` class.

##### Parameters

- `$name` *(string)*: The name of the person or company that is being billed.
- `$surname` *(string)*: The surname of the person or company that is being billed.
- `$street` *(string)*: The street address of the person or company that is being billed.
- `$building` *(string)*: The building number of the person or company that is being billed.
- `$flat` *(string)*: The flat number of the person or company that is being billed.
- `$city` *(string)*: The city of the person or company that is being billed.
- `$region` *(string)*: The region of the person or company that is being billed.
- `$postalCode` *(string)*: The postal code of the person or company that is being billed.
- `$country` *(string)*: The country of the person or company that is being billed.
- `$company` *(string)*: The name of the company that is being billed.

#### `toArray(): array`

This method is used to return an array representation of the `Billing` object.

##### Return Value

- Returns an array with a single key `billing` and an array of all the billing properties.