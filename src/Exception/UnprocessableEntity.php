<?php

declare(strict_types=1);

namespace Simpay\Exception;

class UnprocessableEntity extends \Exception
{
    private const MESSAGE = 'Unprocessable Entity: %s';

    private function __construct(string $message, \Throwable $previous = null)
    {
        parent::__construct(\sprintf(self::MESSAGE, $message), 422, $previous);
    }

    public static function create(string $message, \Throwable $previous = null): self
    {
        return new self($message, $previous);
    }
}
