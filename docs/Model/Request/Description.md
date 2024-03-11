## `Description` Class

The `Description` class is responsible for storing information about a description. It implements the `RequestInterface` which means it has a method `toArray()` that returns an array representation of the description.

### Properties

- `$value` : a private property that holds the description value.

### Methods

- `__construct(string $value)`: a constructor that takes a string parameter representing the description value. It sets the description value to the `$value` property.
- `toArray(): array`: a method that returns an array representation of the description. The returned array has one key-value pair where the key is `'description'` and the value is the description value.

### Example Usage

```php
// Create a new instance of the Description class with a description value of 'Test Description'
$description = new Description('Test Description');

// Get the array representation of the description
$array = $description->toArray();

// Output the array
print_r($array);
// Output: Array ( [description] => Test Description )
```