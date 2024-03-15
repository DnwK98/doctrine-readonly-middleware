<?php

declare(strict_types=1);

namespace Dnwk\DoctrineReadonlyMiddleware\Readonly;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsMiddleware;
use Doctrine\DBAL\Driver;
use Doctrine\DBAL\Driver\Middleware;

#[AsMiddleware(connections: ['default'])]
class ReadonlyMiddleware implements Middleware
{
    private static bool $enabled = false;

    public static function enable(): void
    {
        self::$enabled = true;
    }

    public function wrap(Driver $driver): Driver
    {
        if (self::$enabled) {
            return new ReadonlyDriver($driver);
        }

        return $driver;
    }
}