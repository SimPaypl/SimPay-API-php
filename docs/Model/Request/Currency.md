## `Currency` Class

The `Currency` class is responsible for storing information about a currency. It implements the `RequestInterface` which means it has a method `toArray()` that returns an array representation of the currency.

### Properties

- `$value` : a private property that holds the currency value. Its default value is `'PLN'`.

### Methods

- `__construct(string $currency)`: a constructor that takes a string parameter representing the currency value. It sets the currency value if the parameter is not empty or zero. Otherwise, it throws an `InvalidArgumentException`.
- `createDefault(): self`: a static method that returns a new instance of the `Currency` class with default currency value `'PLN'`.
- `toArray(): array`: a method that returns an array representation of the currency. The returned array has one key-value pair where the key is `'currency'` and the value is the currency value.