<?php

declare(strict_types=1);

namespace Dnwk\DoctrineReadonlyMiddleware\Readonly;

use Doctrine\DBAL\Driver\Middleware\AbstractConnectionMiddleware;
use Doctrine\DBAL\Driver\Result;
use Doctrine\DBAL\Driver\Statement;

class ReadonlyConnection extends AbstractConnectionMiddleware
{
    public static function isSqlReadonly(string $sql): bool
    {
        $notAllowed = [
            "INSERT", "UPDATE", "DELETE", "LOCK", "CALL", // DML
            "CREATE", "DROP", "ALTER", "TRUNCATE", "COMMENT", "RENAME", // DDL
            "COMMIT", "ROLLBACK", "SAVEPOINT", // TCL
            "GRANT", "REVOKE", // DCL
        ];

        $allowed = [
            "SELECT" // DQL
        ];

        foreach ($notAllowed as $notAllowedCheck) {
            if (in_array($notAllowedCheck, explode(" ", $sql))) {
                return false;
            }
        }

        foreach ($allowed as $allowedCheck) {
            if (in_array($allowedCheck, explode(" ", $sql))) {
                return true;
            }
        }

        return false;
    }

    public function prepare(string $sql): Statement
    {
        return new ReadonlyStatement(parent::prepare($sql), $sql);
    }

    public function query(string $sql): Result
    {
        if (!self::isSqlReadonly($sql)) {
            return new EmptyResult();
        }

        return parent::query($sql);
    }

    public function exec(string $sql): int
    {
        if (!self::isSqlReadonly($sql)) {
            return 1;
        }

        return parent::exec($sql);
    }

    public function lastInsertId($name = null): string
    {
        return rand(1000, 9999) . '00';
    }

    public function beginTransaction(): bool
    {
        return true;
    }

    public function commit(): bool
    {
        return true;
    }

    public function rollBack(): bool
    {
        return true;
    }
}
