<?php

namespace SimPay\API\Traits;

use SimPay\API\Components\Pagination;

trait ComponentsTrait
{
    public function getErrorMessage(): string
    {
        return $this->guzzle->getErrorMessage();
    }

    public function getErrorApiMessage(): string
    {
        return $this->guzzle->getErrorApiMessage();
    }

    public function getErrorCode(): int
    {
        return $this->guzzle->getErrorCode();
    }

    /**
     * @return bool|Pagination
     */
    public function pagination()
    {
        if (!$this->guzzle->getPagination()) {
            return false;
        }

        return new Pagination($this->guzzle->getPagination());
    }
}
