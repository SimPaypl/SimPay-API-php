## `Customer` Class

The `Customer` class is responsible for storing information about a customer. It implements the `RequestInterface` which means it has a method `toArray()` that returns an array representation of the customer.

### Properties

- `$name` : a private property that holds the name of the customer.
- `$email` : a private property that holds the email address of the customer.

### Methods

- `__construct(string $name, string $email)`: a constructor that takes two string parameters representing the name and email address of the customer. It sets the properties accordingly.
- `toArray(): array`: a method that returns an array representation of the customer. The returned array has one key-value pair where the key is `'customer'` and the value is an array with two key-value pairs where the keys are `'name'` and `'email'` and the values are the name and email address of the customer respectively.

### Example Usage

```php
// Create a new instance of the Customer class with name 'John Doe' and email 'johndoe@example.com'
$customer = new Customer('John Doe', 'johndoe@example.com');

// Get the array representation of the customer
$array = $customer->toArray();

// Output the array
print_r($array);
// Output: Array ( [customer] => Array ( [name] => John Doe [email] => johndoe@example.com ) )
```