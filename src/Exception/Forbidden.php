<?php

declare(strict_types=1);

namespace Simpay\Exception;

class Forbidden extends \Exception
{
    private const MESSAGE = 'Forbidden: %s';
    private function __construct(string $message, \Throwable $previous = null)
    {
        parent::__construct(\sprintf(self::MESSAGE, $message), 403, $previous);
    }

    public static function create(string $message, \Throwable $previous = null): self
    {
        return new self($message, $previous);
    }
}
