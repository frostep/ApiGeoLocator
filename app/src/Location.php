<?php

declare(strict_types=1);

namespace App\src;

class Location
{
    public function __construct(string $country)
    {
        $this->country = $country;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}
