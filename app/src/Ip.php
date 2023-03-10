<?php

declare(strict_types=1);

namespace App\src;

final class Ip
{
    private $value;

    public function __construct(string $ip)
    {
        if (empty($ip)) {
            throw new \InvalidArgumentException('Empty IP.');
        }
        if (false === filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new \InvalidArgumentException('Invalid IP '.$ip);
        }

        $this->value = $ip;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
