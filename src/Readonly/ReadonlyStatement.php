<?php

declare(strict_types=1);

namespace Dnwk\DoctrineReadonlyMiddleware\Readonly;

use Doctrine\DBAL\Driver\Middleware\AbstractStatementMiddleware;
use Doctrine\DBAL\Driver\Result;
use Doctrine\DBAL\Driver\Statement;

class ReadonlyStatement extends AbstractStatementMiddleware
{
    private string $sql;

    public function __construct(Statement $wrappedStatement, string $sql)
    {
        parent::__construct($wrappedStatement);
        $this->sql = $sql;
    }

    public function execute($params = null): Result
    {
        if (!ReadonlyConnection::isSqlReadonly($this->sql)) {
            return new EmptyResult();
        }

        return parent::execute($params);
    }
}