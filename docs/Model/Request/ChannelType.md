# Documentation

## Class: ChannelType

This class is used to represent the types of channels in a request to Simpay API.

### Properties

#### `$blik` *(bool)*

This property indicates whether the channel supports BLIK.

#### `$transfer` *(bool)*

This property indicates whether the channel supports bank transfer.

#### `$cards` *(bool)*

This property indicates whether the channel supports card payments.

#### `$ewallets` *(bool)*

This property indicates whether the channel supports e-wallet payments (Google Pay, Apple Pay).

#### `$paypal` *(bool)*

This property indicates whether the channel supports PayPal.

#### `$paysafe` *(bool)*

This property indicates whether the channel supports Paysafe group payments (Skrill, PaysafeCard).

#### `$latam` *(bool)*

This property indicates whether the channel supports South American payments (PIX, Boleto, BoletoFlash).

#### `$postponed` *(bool)*

This property indicates whether the channel supports postponed payments.

### Methods

#### `__construct(bool $blik = false, bool $transfer = false, bool $cards = false, bool $ewallets = false, bool $paypal = false, bool $paysafe = false, bool $latam = false, bool $postponed = false)`

This method is used to create a new instance of the `ChannelType` class.

##### Parameters

- `$blik` *(bool)*: Indicates whether the channel supports BLIK.
- `$transfer` *(bool)*: Indicates whether the channel supports bank transfer.
- `$cards` *(bool)*: Indicates whether the channel supports card payments.
- `$ewallets` *(bool)*: Indicates whether the channel supports e-wallet payments.
- `$paypal` *(bool)*: Indicates whether the channel supports PayPal.
- `$paysafe` *(bool)*: Indicates whether the channel supports Paysafe group payments (Skrill, PaysafeCard).
- `$latam` *(bool)*: Indicates whether the channel supports South American payments (PIX, Boleto, BoletoFlash).
- `$postponed` *(bool)*: Indicates whether the channel supports postponed payments.

#### `toArray(): array`

This method is used to return an array representation of the `ChannelType` object.

##### Return Value

- Returns an array with a single key `channelTypes` and an array of all the channel type properties.
