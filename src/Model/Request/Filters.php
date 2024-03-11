<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class Filters implements RequestInterface
{
    private ?DirectBillingTransactionStatus $status;
    private ?PhoneNumber $phoneNumber;
    private ?Control $control;

    public function __construct(
        ?DirectBillingTransactionStatus $status = null,
        ?PhoneNumber $phoneNumber = null,
        ?Control $control = null
    ) {
        $this->status = $status;
        $this->phoneNumber = $phoneNumber;
        $this->control = $control;
    }

    public function toArray(): array
    {
        $filters = [];

        if (null !== $this->status) {
            $filters += $this->status->toArray();
        }

        if (null !== $this->phoneNumber) {
            $filters += $this->phoneNumber->toArray();
        }

        if (null !== $this->control) {
            $filters += $this->control->toArray();
        }

        return [
            'filter' => $filters,
        ];
    }
}
