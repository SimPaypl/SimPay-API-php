<?php

declare(strict_types=1);

namespace Simpay\Exception;

class InternalServerError extends \Exception
{
    private const MESSAGE = 'Internal Server Error: %s';

    private function __construct(string $message, \Throwable $previous = null)
    {
        parent::__construct(\sprintf(self::MESSAGE, $message), 500, $previous);
    }

    public static function create(string $message, \Throwable $previous = null): self
    {
        return new self($message, $previous);
    }
}
