## `DirectBillingTransactionStatus` Class

The `DirectBillingTransactionStatus` class is responsible for storing information about the status of a direct billing transaction. It implements the `RequestInterface` which means it has a method `toArray()` that returns an array representation of the status.

### Properties

- `$value` : a private property that holds the status value.

### Methods

- `__construct(string $value)`: a private constructor that takes a string parameter representing the status value. It sets the status value if the parameter is a valid status. Otherwise, it throws an `InvalidArgumentException`.
- `new(): self`: a static method that returns a new instance of the `DirectBillingTransactionStatus` class with status value `'transaction_db_new'`.
- `confirmed(): self`: a static method that returns a new instance of the `DirectBillingTransactionStatus` class with status value `'transaction_db_confirmed'`.
- `payed(): self`: a static method that returns a new instance of the `DirectBillingTransactionStatus` class with status value `'transaction_db_payed'`.
- `rejected(): self`: a static method that returns a new instance of the `DirectBillingTransactionStatus` class with status value `'transaction_db_rejected'`.
- `toArray(): array`: a method that returns an array representation of the status. The returned array has one key-value pair where the key is `'status'` and the value is the status value.

### Example Usage

```php
// Create a new instance of the DirectBillingTransactionStatus class with status value 'transaction_db_new'
$status = DirectBillingTransactionStatus::new();

// Get the array representation of the status
$array = $status->toArray();

// Output the array
print_r($array);
// Output: Array ( [status] => transaction_db_new )

// Create a new instance of the DirectBillingTransactionStatus class with status value 'transaction_db_payed'
$status = DirectBillingTransactionStatus::payed();

// Get the array representation of the status
$array = $status->toArray();

// Output the array
print_r($array);
// Output: Array ( [status] => transaction_db_payed )
```