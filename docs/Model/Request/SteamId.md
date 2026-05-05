# `SteamId` Class

The `SteamId` class represents the buyer's STEAMID64 attached to a DirectBilling transaction. It implements `RequestInterface` and serializes to the API's `steamid` field.

## Usage

```php
use Simpay\Model\Request\SteamId;

$steamId = new SteamId('76561198000000000');

print_r($steamId->toArray());
// ["steamid" => "76561198000000000"]
```

## Constructor

```php
public function __construct(string $id)
```

- `$id` — STEAMID64 as string.

## Method

### `toArray(): array`

Returns `['steamid' => $id]`.
