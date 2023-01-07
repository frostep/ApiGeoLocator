<?php

declare(strict_types=1);

namespace App\src;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class LocatorTest extends TestCase
{
    private MockObject $client;
    private Locator $locator;

    protected function setUp(): void
    {
        $this->client = $this->createMock(HttpClient::class);
        $this->locator = new Locator($this->client);
    }

    public function testSuccess(): void
    {
        $this->client->method('get')->willReturn(json_encode([
            'country_name' => 'United States of America',
        ]));

        $location = $this->locator->locate(new Ip('8.8.8.8'));

        self::assertNotNull($location);
        self::assertEquals('United States of America', $location->getCountry());
        // self::assertEquals('California', $location->getRegion());
        // self::assertEquals('Mountain View', $location->getCity());
    }

    public function testNotFound(): void
    {
        $this->client->method('get')
            ->willReturn(json_encode([
                'country_name' => '-',
            ]))
        ;
        $location = $this->locator->locate(new Ip('127.0.0.1'));
        self::assertNull($location);
    }
}
