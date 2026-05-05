## `Antifraud` Class

The `Antifraud` class carries optional anti‑fraud metadata about the buyer that is forwarded to SimPay together with the payment request. It implements `RequestInterface` and exposes a `toArray()` method for serialization.

### When it is required

When you create a transaction with [`DirectChannel`](DirectChannel.md) (i.e. the buyer is redirected straight to a single payment channel such as `blik`), SimPay requires:

- `customer.ip` — see [`Customer`](Customer.md)
- `customer.countryCode` — see [`Customer`](Customer.md)
- `antifraud.useragent` — provided by this class

Without these fields the API responds with `422 Unprocessable Entity: Error validation`.

### Properties

- `$useragent` — buyer's `User-Agent` HTTP header (string, required for `directChannel`)
- `$steamid` — buyer's STEAMID64 (integer, optional)
- `$mcusername` — Minecraft nickname (string, optional)
- `$mcid` — Minecraft player UUID (string, optional)

### Constructor

```php
public function __construct(
    ?string $useragent = null,
    ?int $steamid = null,
    ?string $mcusername = null,
    ?string $mcid = null
)
```

### `toArray(): array`

Returns:

```php
[
    'antifraud' => [
        'useragent' => 'Mozilla/5.0 ...',
        'steamid'   => 76561198000000000,
        'mcusername' => null,
        'mcid'      => null,
    ],
]
```

### Example: direct BLIK transaction

```php
use Simpay\Model\Request\Amount;
use Simpay\Model\Request\Antifraud;
use Simpay\Model\Request\CallbackReturnUrl;
use Simpay\Model\Request\Control;
use Simpay\Model\Request\CreatePayment;
use Simpay\Model\Request\Currency;
use Simpay\Model\Request\Customer;
use Simpay\Model\Request\Description;
use Simpay\Model\Request\DirectChannel;

$createPayment = new CreatePayment(
    new Amount(100.00),
    [], // cart
    null, // channelType
    new Currency('PLN'),
    new Description('FlashSkins'),
    new Control('100519'),
    new Customer(
        '',
        'buyer@example.com',
        $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1', // ip — required for directChannel
        'PL'                                    // countryCode — required for directChannel
    ),
    null, // billing
    null, // shipping
    new CallbackReturnUrl(
        'https://flashskins.gg/payments?status=success',
        'https://flashskins.gg/payments?status=failure'
    ),
    new DirectChannel('blik'),
    null, // channels
    null, // referer
    new Antifraud(
        $_SERVER['HTTP_USER_AGENT'] ?? '', // useragent — required for directChannel
        76561198000000000                  // steamid — optional
    )
);
```
