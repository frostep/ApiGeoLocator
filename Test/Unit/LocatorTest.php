<?php

declare(strict_types=1);

namespace App\src;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class LocatorTest extends TestCase
{
    private Locator $locator;

    protected function setUp(): void
    {
        $this->locator = new Locator();
    }

    public function testSuccess(): void
    {
        $location = $this->locator->locate(new Ip('8.8.8.8'));

        self::assertNotNull($location);
        self::assertEquals('United States of America', $location->getCountry());
        // self::assertEquals('California', $location->getRegion());
        // self::assertEquals('Mountain View', $location->getCity());
    }

    public function testNotFound(): void
    {
        $location = $this->locator->locate(new Ip('127.0.0.1'));
        self::assertNull($location);
    }
}
