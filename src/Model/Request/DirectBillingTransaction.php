<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class DirectBillingTransaction implements RequestInterface
{
    private Amount $amount;
    private ?AmountType $amountType;
    private ?Description $description;
    private ?Control $control;
    private ?PhoneNumber $phoneNumber;
    private ?StreamId $steamId;
    private ?CallbackReturnUrl $returns;

    public function __construct(
        Amount $amount,
        ?AmountType $amountType = null,
        ?Description $description = null,
        ?Control $control = null,
        ?CallbackReturnUrl $returns = null,
        ?PhoneNumber $phoneNumber = null,
        ?StreamId $steamId = null
    ) {
        $this->amount = $amount;
        $this->amountType = $amountType;
        $this->description = $description;
        $this->control = $control;
        $this->phoneNumber = $phoneNumber;
        $this->steamId = $steamId;
        $this->returns = $returns;
    }

    public function toArray(): array
    {
        $data = [];
        $data += $this->amount->toArray();

        if (null !== $this->amountType) {
            $data += $this->amountType->toArray();
        }
        if (null !== $this->description) {
            $data += $this->description->toArray();
        }
        if (null !== $this->control) {
            $data += $this->control->toArray();
        }
        if (null !== $this->phoneNumber) {
            $data += $this->phoneNumber->toArray();
        }
        if (null !== $this->steamId) {
            $data += $this->steamId->toArray();
        }
        if (null !== $this->returns) {
            $data += $this->returns->toArray();
        }

        return $data;
    }
}
