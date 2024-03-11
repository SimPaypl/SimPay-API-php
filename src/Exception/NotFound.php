<?php

declare(strict_types=1);

namespace Simpay\Exception;

class NotFound extends \Exception
{
    public const MESSAGE = 'Not Found: %s';
    private function __construct(string $message, \Throwable $previous = null)
    {
        parent::__construct(\sprintf(self::MESSAGE, $message), 404, $previous);
    }

    public static function create(string $message, \Throwable $previous = null): self
    {
        return new self($message, $previous);
    }
}
