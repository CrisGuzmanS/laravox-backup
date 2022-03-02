<?php

declare(strict_types=1);

namespace Laravox\Backup\Strategies;

use Exception;

class StrategyFactory
{
    public function handle(string $connection): Strategy
    {
        switch ($connection) {
            case 'mysql':
                return new MysqlStrategy();
                break;
            case 'pgsql':
                return new PostgresStrategy();
                break;
            default:
                throw new Exception("Connection $connection not found");
                break;
        }
    }
}
