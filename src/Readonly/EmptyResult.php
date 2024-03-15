<?php

namespace Dnwk\DoctrineReadonlyMiddleware\Readonly;

use Doctrine\DBAL\Driver\Result;

final class EmptyResult implements Result
{
    public function fetchNumeric(): bool
    {
        return false;
    }

    public function fetchAssociative(): bool
    {
        return false;
    }

    public function fetchOne(): bool
    {
        return false;
    }

    public function fetchAllNumeric(): array
    {
        return [];
    }

    public function fetchAllAssociative(): array
    {
        return [];
    }

    public function fetchFirstColumn(): array
    {
        return [];
    }

    public function rowCount(): int
    {
        return 0;
    }

    public function columnCount(): int
    {
        return 0;
    }

    public function free(): void
    {
    }
}