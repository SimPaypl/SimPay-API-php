# Simpay\HttpClientFactory

The `Simpay\HttpClientFactory` class implements the `Simpay\HttpClientFactoryInterface` and is used to create an instance of the Guzzle HTTP client to make requests to the Simpay API.

## Properties

| Name | Type | Description |
|------|------|-------------|
| `$configuration` | Configuration | The configuration object used to set the headers for the HTTP client |

## Methods

### `__construct`

```php
public function __construct(Configuration $configuration)
```

This method is the constructor of the `Simpay\HttpClientFactory` class. It takes in one parameter:

* `$configuration` - An instance of the `Simpay\Configuration` class containing the API credentials.

It sets the `$configuration` property to the given parameter.

### `create`

```php
public function create(): ClientInterface
```

This method creates an instance of the Guzzle HTTP client and sets the base URI and headers to the values defined in the configuration object. It returns the created HTTP client.

## Example

```php
$configuration = new Configuration('https://api.simpay.pl', '123456', 'qwerty');
$httpClientFactory = new HttpClientFactory($configuration);

$http = $httpClientFactory->create();
```