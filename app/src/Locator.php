<?php

declare(strict_types=1);

namespace App\src;

class Locator
{
    public function __construct(
        private HttpClient $client,
        // private string $apiKey)
    ) {
        $this->client = $client;
        // $this->apiKey = $apiKey;//Это для платных api
    }

    public function locate(Ip $ip): ?Location
    {
        $url = 'https://api.iplocation.net/?'.http_build_query([
            'ip' => $ip->getValue(),
        ]);

        // $response = file_get_contents($url);
        // curl

        $response = $this->client->get($url);

        $data = json_decode($response, true);

        $data = array_map(
            fn ($value) => '-' !== $value ? $value : null,
            $data
        );

        if (empty($data['country_name'])) {
            return null;
        }

        return new Location($data['country_name']);
    }
}
