<?php

declare(strict_types=1);

namespace Dnwk\DoctrineReadonlyMiddleware\Readonly;

use Doctrine\DBAL\Driver;
use Doctrine\DBAL\Driver\Connection as DriverConnection;
use Doctrine\DBAL\Driver\Middleware\AbstractDriverMiddleware;

class ReadonlyDriver extends AbstractDriverMiddleware implements Driver
{
    public function connect(array $params): DriverConnection
    {
        return new ReadonlyConnection(parent::connect($params));
    }
}
