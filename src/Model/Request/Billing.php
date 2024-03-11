<?php

declare(strict_types=1);

namespace Simpay\Model\Request;

class Billing implements RequestInterface
{
    private string $name;
    private string $surname;
    private string $street;
    private string $building;
    private string $flat;
    private string $city;
    private string $region;
    private string $postalCode;
    private string $country;
    private string $company;

    public function __construct(
        string $name,
        string $surname,
        string $street,
        string $building,
        string $flat,
        string $city,
        string $region,
        string $postalCode,
        string $country,
        string $company
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

    public function toArray(): array
    {
        return [
            'billing' => [
                'name' => $this->name,
                'surname' => $this->surname,
                'street' => $this->street,
                'building' => $this->building,
                'flat' => $this->flat,
                'city' => $this->city,
                'region' => $this->region,
                'postal_code' => $this->postalCode,
                'country' => $this->country,
                'company' => $this->company,
            ],
        ];
    }
}
