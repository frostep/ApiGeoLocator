<?php

declare(strict_types=1);

namespace App\src;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class IPTest extends TestCase
{
    /**
     * testIp4.
     */
    public function testIp4(): void
    {
        $ip = new IP($value = '8.8.8.8');
        self::assertEquals($value, $ip->getValue());
    }

    public function testInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new IP('incorrect');
    }

    public function testEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new IP('');
    }
}
