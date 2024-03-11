# Class CreatePayment

The `CreatePayment` class implements the `RequestInterface` and represents a payment creation request model. It contains information about the payment such as the amount, cart, currency, description, control, customer, billing, shipping, callback return URL, direct channel, channels, channel type, and referer.

## Properties

- `amount` - an object of the `Amount` class representing the payment amount.
- `currency` - an optional object of the `Currency` class representing the payment currency.
- `description` - an optional object of the `Description` class representing the payment description.
- `control` - an optional object of the `Control` class representing the payment control.
- `customer` - an optional object of the `Customer` class representing the payment customer.
- `billing` - an optional object of the `Billing` class representing the payment billing.
- `shipping` - an optional object of the `Shipping` class representing the payment shipping.
- `cart` - an array of `CartItem` objects representing the payment cart.
- `returns` - an optional object of the `CallbackReturnUrl` class representing the payment callback return URL.
- `directChannel` - an optional object of the `DirectChannel` class representing the payment direct channel.
- `channels` - an optional array of `Channel` objects representing the payment channels.
- `channelType` - an optional object of the `ChannelType` class representing the payment channel type.
- `referer` - an optional object of the `Referer` class representing the payment referer.

## Methods

- `__construct(Amount $amount, array $cart, ?ChannelType $channelType = null, ?Currency $currency = null, ?Description $description = null, ?Control $control = null, ?Customer $customer = null, ?Billing $billing = null, ?Shipping $shipping = null, ?CallbackReturnUrl $returns = null, ?DirectChannel $directChannel = null, ?array $channels = null, ?Referer $referer = null)` - the constructor of the class that initializes its properties.
- `toArray(): array` - returns an array representation of the class properties.

## Example usage

```php
$amount = new Amount(1000, 2);
$cart = [
    new CartItem('Product 1', 500, 1),
    new CartItem('Product 2', 500, 1),
];
$currency = new Currency('EUR');
$description = new Description('Payment for products');
$control = new Control('123456');
$customer = new Customer('John', 'Doe', 'john.doe@example.com');
$billing = new Billing('John', 'Doe', '123 Main St', 'Anytown', '12345', 'US', '1234567890');
$shipping = new Shipping('John', 'Doe', '123 Main St', 'Anytown', '12345', 'US', '1234567890');
$returns = new CallbackReturnUrl('https://example.com/callback');
$directChannel = new DirectChannel('web');
$channels = [
    new Channel(Channel::VISA),
    new Channel(Channel::MASTERCARD),
];
$channelType = new ChannelType(ChannelType::ECOMMERCE);
$referer = new Referer('https://example.com');

$request = new CreatePayment(
    $amount,
    $cart,
    $channelType,
    $currency,
    $description,
    $control,
    $customer,
    $billing,
    $shipping,
    $returns,
    $directChannel,
    $channels,
    $referer
);

$requestData = $request->toArray();
```

In this example, we create a new `CreatePayment` request object with all the required and optional properties initialized. We then call the `toArray()` method to get an array representation of the request data.