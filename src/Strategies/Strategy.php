<?php

namespace Laravox\Backup\Strategies;

abstract class Strategy
{
    abstract protected function database(): string;
    abstract protected function username(): string;
    abstract protected function host(): string;
    abstract protected function port(): string;
    abstract protected function password(): string;
    abstract public function storeBackupCommand(string $path): string;
    abstract public function recreateDatabaseCommand(): string;
    abstract public function restoreDatabaseCommand(string $path): string;
}
