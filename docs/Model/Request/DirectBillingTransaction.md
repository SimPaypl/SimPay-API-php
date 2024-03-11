## `DirectBillingTransaction` Class

The `DirectBillingTransaction` class is responsible for storing information about a direct billing transaction. It implements the `RequestInterface` which means it has a method `toArray()` that returns an array representation of the direct billing transaction.

### Properties

- `$amount` : a private property that holds an instance of the `Amount` class representing the amount of the transaction.
- `$amountType` : a private property that holds an optional instance of the `AmountType` class representing the type of the amount of the transaction.
- `$description` : a private property that holds an optional instance of the `Description` class representing the description of the transaction.
- `$control` : a private property that holds an optional instance of the `Control` class representing the control data of the transaction.
- `$phoneNumber` : a private property that holds an optional instance of the `PhoneNumber` class representing the phone number of the customer.
- `$streamId` : a private property that holds an optional instance of the `StreamId` class representing the stream ID of the transaction.
- `$returns` : a private property that holds an optional instance of the `CallbackReturnUrl` class representing the return URL of the transaction.

### Methods

- `__construct(Amount $amount, ?AmountType $amountType = null, ?Description $description = null, ?Control $control = null, ?CallbackReturnUrl $returns = null, ?PhoneNumber $phoneNumber = null, ?StreamId $steamId = null)`: a constructor that takes the following parameters:
    - `$amount` : an instance of the `Amount` class representing the amount of the transaction.
    - `$amountType` : an optional instance of the `AmountType` class representing the type of the amount of the transaction. Default value is `null`.
    - `$description` : an optional instance of the `Description` class representing the description of the transaction. Default value is `null`.
    - `$control` : an optional instance of the `Control` class representing the control data of the transaction. Default value is `null`.
    - `$returns` : an optional instance of the `CallbackReturnUrl` class representing the return URL of the transaction. Default value is `null`.
    - `$phoneNumber` : an optional instance of the `PhoneNumber` class representing the phone number of the customer. Default value is `null`.
    - `$steamId` : an optional instance of the `StreamId` class representing the stream ID of the transaction. Default value is `null`.
- `toArray(): array`: a method that returns an array representation of the direct billing transaction. The returned array is a merge of all the arrays returned by the `toArray()` methods of the properties of the class that are not `null`.

### Example Usage

```php
// Create a new instance of the DirectBillingTransaction class with amount 10.50 PLN
$amount = new Amount(10.50, new Currency('PLN'));
$transaction = new DirectBillingTransaction($amount);

// Get the array representation of the transaction
$array = $transaction->toArray();

// Output the array
print_r($array);
```