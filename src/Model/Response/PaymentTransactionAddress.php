<?php

declare(strict_types=1);

namespace Simpay\Model\Response;

class PaymentTransactionAddress
{
    public ?string $name;
    public ?string $surname;
    public ?string $street;
    public ?string $building;
    public ?string $flat;
    public ?string $city;
    public ?string $region;
    public ?string $postalCode;
    public ?string $country;
    public ?string $company;

    private function __construct(
        ?string $name,
        ?string $surname,
        ?string $street,
        ?string $building,
        ?string $flat,
        ?string $city,
        ?string $region,
        ?string $postalCode,
        ?string $country,
        ?string $company
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->street = $street;
        $this->building = $building;
        $this->flat = $flat;
        $this->city = $city;
        $this->region = $region;
        $this->postalCode = $postalCode;
        $this->country = $country;
        $this->company = $company;
    }

    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['name'],
            $data['surname'],
            $data['street'],
            $data['building'],
            $data['flat'],
            $data['city'],
            $data['region'],
            $data['postalCode'],
            $data['country'],
            $data['company'],
        );
    }
}
