<?php

declare(strict_types=1);

namespace Simpay\Exception;

use GuzzleHttp\Exception\RequestException;

class ExceptionFactory
{
    public static function create(RequestException $exception): \Exception
    {
        /** @psalm-suppress PossiblyNullReference */
        $error = \json_decode($exception->getResponse()->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR,);
        $message = $error['message'] ?? '';

        switch ($exception->getCode()) {
            case 401:
                return Unauthorized::create($message);

            case 403:
                return Forbidden::create($message);

            case 404:
                return NotFound::create($message);

            case 422:
                return UnprocessableEntity::create($message);

            case 500:
                return InternalServerError::create($message);

            default:
                return Unknown::create($message, $exception);
        }
    }
}
