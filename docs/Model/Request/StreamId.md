# StreamId Class

The `StreamId` class is a simple model class that implements the `RequestInterface`. It represents a stream ID used for streaming data.

## Usage

To use the `StreamId` class, you first need to instantiate it with a valid string ID.

```php
use Simpay\Model\Request\StreamId;

// Instantiate a StreamId object with a valid string ID
$streamId = new StreamId('abc123');

// Output the stream ID as an array
print_r($streamId->toArray()); // ["stream_id" => "abc123"]
```

## Methods

### `__construct(string $id)`

Instantiates a `StreamId` object with a valid string ID.

**Parameters:**
- `$id` : string - The string ID.

### `toArray(): array`

Returns the stream ID as an array.

**Returns:**
- array - The stream ID as an array.

## Example

```php
use Simpay\Model\Request\StreamId;

// Instantiate a StreamId object with a valid string ID
$streamId = new StreamId('abc123');

// Output the stream ID as an array
print_r($streamId->toArray()); // ["stream_id" => "abc123"]
```