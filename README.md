# SimPay-API-php

## SMS XML
Partner przygotowuje link URL zgodnie z opisaną specyfikacją SimPay. W momencie złożenia przez użytkownika zamówienia (wysłanie wiadomości SMS), nasz system odpytuje URL podany przez partnera oraz pobiera kod bezpośrednio.

[Przykłady Implementacji](https://github.com/SimPaypl/SimPay-API-php/tree/master/examples/smsXml)

## Direct Billing
Płatności Direct Billing

[Przykłady](https://github.com/SimPaypl/SimPay-API-php/tree/master/examples/directbilling)

## SMS
Płatności SMS obsługiwane przez SimPay

[Przykłady](https://github.com/SimPaypl/SimPay-API-php/tree/master/examples/sms)

## Requirements
* PHP 5.3+

## Installation

The SimPay_PHP_SMS_Client can be installed using [Composer](https://packagist.org/packages/simpaypl/sms_xml_api).

### Composer

#### Automatic install
```composer require simpaypl/sms_xml_api```

#### Manual install
Inside of `composer.json` specify the following:

``` json
{
  "require": {
    "simpaypl/sms_xml_api": "dev-master"
  }
}
```

# Kontakt
W razie jakicholwiek pytań w implementacji , problemów, próśb o dodanie funkcjonalności zachęcamy do kontaktu poprzez:

<kontakt@simpay.pl>
