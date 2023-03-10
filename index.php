<?php

declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

use App\src\HttpClient;
use App\src\Ip;
use App\src\Locator;

$locator = new Locator(new HttpClient());
$locator = $locator->locate(new Ip('8.8.8.8'));

$country = $locator ? $locator->getCountry() : '';

print_r($country);
