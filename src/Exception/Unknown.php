<?php

declare(strict_types=1);

namespace Simpay\Exception;

class Unknown extends \Exception
{
    private const MESSAGE = 'Unknown: %s, please contact the administrator.';
    private function __construct(string $message, \Throwable $previous = null)
    {
        parent::__construct(\sprintf(self::MESSAGE, $message), 404, $previous);
    }

    public static function create(string $message, \Throwable $previous = null): self
    {
        return new self($message, $previous);
    }
}
