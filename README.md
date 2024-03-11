## Simpay.pl API PHP SDK

# Description

This documentation is intended for current and future Simpay Partners. Prior to implementation, it is necessary to define the service in the Partner Panel and wait for its activation directly from the operators.

## Installation & Usage

### Requirements

PHP 7.4 and later.
Should also work with PHP 8.0.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/8lines/simpay-php-sdk.git"
    }
  ],
  "require": {
    "8lines/simpay-php-sdk": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/prject/path/vendor/autoload.php');
```

## Getting Started

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

$configuration = new Configuration('your_api_key', 'your_api_password', 'en');
$client = new Client([
    'base_uri' => Configuration::API_BASE_URI,
]);

$api = new Simpay\DirectBillingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    $client,
    $config
);

try {
    $result = $api->directBillingGetServices();
    print_r($result);
} catch (\Exception $e) {
    echo 'Exception when calling DirectBillingApi->directbillingGetServices: ', $e->getMessage(), PHP_EOL;
}

```
### Examples

All examples are in the [examples](docs/examples/) directory.

## Documentation for API Endpoints

## API Endpoints

All URIs are relative to *https://api.simpay.pl*
- [Configuration](docs/Configuration.md)
- [DirectBillingApi](docs/DirectBillingApi.md)
- [DirectBillingCalculateApi](docs/DirectBillingCalculateApi.md)
- [DirectBillingTransactionApi](docs/DirectBillingTransactionApi.md)
- [HttpClientFactory](docs/HttpClientFactory.md)
- [PaymentApi](docs/PaymentApi.md)
- [SmsNumberApi](docs/SmsNumberApi.md)
- [SmsServiceApi](docs/SmsServiceApi.md)
- [SmsTransactionApi](docs/SmsTransactionApi.md)

## Models

### Requests:
- [Amount](docs/Model/Amount.md)
- [AmountType](docs/Model/AmountType.md)
- [Billing](docs/Model/Billing.md)
- [CallbackReturnUrl](docs/Model/Request/CallbackReturnUrl.md)
- [CartItem](docs/Model/Request/CartItem.md)
- [Channel](docs/Model/Request/Channel.md)
- [ChannelType](docs/Model/Request/ChannelType.md)
- [Control](docs/Model/Request/Control.md)
- [CreatePayment](docs/Model/Request/CreatePayment.md)
- [Currency](docs/Model/Request/Currency.md)
- [Customer](docs/Model/Request/Customer.md)
- [Description](docs/Model/Request/Description.md)
- [DirectBillingTransaction](docs/Model/Request/DirectBillingTransaction.md)
- [DirectBillingTransactionStatus](docs/Model/Request/DirectBillingTransactionStatus.md)
- [DirectChannel](docs/Model/Request/DirectChannel.md)
- [Filters](docs/Model/Request/Filters.md)
- [Operator](docs/Model/Request/Operator.md)
- [PaymentTransactionId](docs/Model/Request/PaymentTransactionId.md)
- [PhoneNumber](docs/Model/Request/PhoneNumber.md)
- [Referer](docs/Model/Request/Referer.md)
- [ServiceId](docs/Model/Request/ServiceId.md)
- [ServiceNumber](docs/Model/Request/ServiceNumber.md)
- [Shipping](docs/Model/Request/Shipping.md)
- [SmsCode](docs/Model/Request/SmsCode.md)
- [SmsNumber](docs/Model/Request/SmsNumber.md)
- [SmsTransactionId](docs/Model/Request/SmsTransactionId.md)
- [StreamId](docs/Model/Request/StreamId.md)

### Responses:
- [Amount](docs/Model/Response/Amount.md)
- [AmountType](docs/Model/Response/AmountType.md)
- [CallbackReturnUrl](docs/Model/Response/CallbackReturnUrl.md)
- [DirectBillingTransaction](docs/Model/Response/DirectBillingTransaction.md)
- [DirectBillingTransactionCollection](docs/Model/Response/DirectBillingTransactionCollection.md)
- [DirectBillingTransactionList](docs/Model/Response/DirectBillingTransactionList.md)
- [DirectBillingTransactionNotify](docs/Model/Response/DirectBillingTransactionNotify.md)
- [Operator](docs/Model/Response/Operator.md)
- [Pagination](docs/Model/Response/Pagination.md)
- [PaginationLinks](docs/Model/Response/PaginationLinks.md)
- [PaymentChannel](docs/Model/Response/PaymentChannel.md)
- [PaymentChannelCollection](docs/Model/Response/PaymentChannelCollection.md)
- [PaymentCreate](docs/Model/Response/PaymentCreate.md)
- [PaymentService](docs/Model/Response/PaymentService.md)
- [PaymentServiceCollection](docs/Model/Response/PaymentServiceCollection.md)
- [PaymentServiceTransaction](docs/Model/Response/PaymentServiceTransaction.md)
- [PaymentServiceTransactionCollection](docs/Model/Response/PaymentServiceTransactionCollection.md)
- [PaymentServiceTransactionStatus](docs/Model/Response/PaymentServiceTransactionStatus.md)
- [PaymentServiceTransaction](docs/Model/Response/PaymentServiceTransaction.md)
- [PaymentServiceTransactionAddress](docs/Model/Response/PaymentTransactionAddress.md)
- [PaymentServiceTransactionAmount](docs/Model/Response/PaymentTransactionAmount.md)
- [PaymentServiceTransactionCartItems](docs/Model/Response/PaymentTransactionCartItem.md)
- [PaymentServiceTransactionCustomer](docs/Model/Response/PaymentTransactionCustomer.md)
- [PaymentServiceTransactionRedirect](docs/Model/Response/PaymentTransactionRedirect.md)
- [Service](docs/Model/Response/Service.md)
- [ServiceCalculation](docs/Model/Response/ServiceCalculation.md)
- [ServiceCalculationOperatorAmount](docs/Model/Response/ServiceCalculationOperatorAmount.md)
- [ServiceCollection](docs/Model/Response/ServiceCollection.md)
- [ServiceNumber](docs/Model/Response/ServiceNumber.md)
- [ServiceStatus](docs/Model/Response/ServiceStatus.md)
- [ServiceType](docs/Model/Response/ServiceType.md)
- [SmsNumber](docs/Model/Response/SmsNumber.md)
- [SmsNumberCollection](docs/Model/Response/SmsNumberCollection.md)
- [SmsService](docs/Model/Response/SmsService.md)
- [SmsServiceCheckCodeData](docs/Model/Response/SmsServiceCheckCodeData.md)
- [SmsServiceCollection](docs/Model/Response/SmsServiceCollection.md)
- [SmsTransaction](docs/Model/Response/SmsTransaction.md)
- [SmsTransactionCollection](docs/Model/Response/SmsTransactionCollection.md)

### Exceptions:

- [Simpay\Exception\ExceptionFactory](docs/Exception/ExceptionFactory.md)
- [Simpay\Exception\Forbidden](docs/Exception/Forbidden.md)
- [Simpay\Exception\InternalServerError](docs/Exception/InternalServerError.md)
- [Simpay\Exception\NotFound](docs/Exception/NotFound.md)
- [Simpay\Exception\Unauthorized](docs/Exception/Unauthorized.md)
- [Simpay\Exception\Unknown](docs/Exception/Unknown.md)
- [Simpay\Exception\UnprocessableEntity](docs/Exception/UnprocessableEntity.md)

All the exceptions have the `getErrors` method which returns an array of errors returned by the API.

## Tests

To run the tests, use:

```bash
composer install
bin/phpunit
```

## Docker

To build the Docker image:

```bash
make build
```
To run the Docker image:

```bash
make up
```

Enter the container (bash):

```bash
make bash
```

To run the tests:

```bash
make test
```

To run the linter:

```bash
make lint
```

## About this package

- API version: `1.0.0`
