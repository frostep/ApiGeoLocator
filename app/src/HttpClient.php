<?php

declare(strict_types=1);

namespace App\src;

class HttpClient
{
    public function __construct()
    {
    }

    public function get(string $url): ?string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        // проверка
        false === $response ? curl_error($ch) : '';
        curl_close($ch);

        return $response;
    }
}
