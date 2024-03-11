# Simpay\Configuration class documentation

This class represents the configuration of the Simpay API. It sets the API base URI, version, and authentication header.

## Constants

- `API_BASE_URI` : A constant string representing the base URI of Simpay's API.
- `VERSION` : A constant string representing the version of Simpay's API.

## Properties

- `$apiKey` : A private string representing the API key required for authentication.
- `$apiPassword` : A private string representing the API password required for authentication.
- `$lang` : A private string representing the language of the API response. It defaults to 'en'.

## Methods

### __construct(string $apiKey, string $apiPassword, string $lang = 'en')

This is the constructor method of the class. It sets the values of the `$apiKey`, `$apiPassword`, and `$lang` properties.

#### Parameters

- `$apiKey` : A required string representing the API key required for authentication.
- `$apiPassword` : A required string representing the API password required for authentication.
- `$lang` : An optional string representing the language of the API response. It defaults to 'en'.

### getAuthHeader(): array

This method returns an array of authentication headers required for making a request to Simpay's API.

#### Returns

- An array of authentication headers containing the API key, API password, language, version, and platform.