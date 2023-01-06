<?php

declare(strict_types=1);

namespace App\src;

class Locator
{
    public function locate(Ip $ip): ?Location
    {
        $url = 'https://api.iplocation.net/?'.http_build_query([
            'ip' => $ip->getValue(),
        ]);

        // $response = file_get_contents($url);
        // curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($response, true);

        $data = array_map(function ($value) {
            return '-' !== $value ? $value : null;
        }, $data);

        if (empty($data['country_name'])) {
            return null;
        }

        return new Location($data['country_name']);
    }
}
