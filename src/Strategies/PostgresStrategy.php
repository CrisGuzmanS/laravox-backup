<?php

namespace Laravox\Backup\Strategies;

class PostgresStrategy extends Strategy
{
    protected function database(): string
    {
        return config('database.connections.pgsql.database');
    }

    protected function password(): string
    {
        return config('database.connections.pgsql.password');
    }

    protected function username(): string
    {
        return config('database.connections.pgsql.username');
    }

    protected function host(): string
    {
        return config('database.connections.pgsql.host');
    }

    protected function port(): string
    {
        return config('database.connections.pgsql.port');
    }

    public function storeBackupCommand(string $path): string
    {
        $username = $this->username();
        $host = $this->host();
        $port = $this->port();
        $password = $this->password();
        $database = $this->database();

        return "PGPASSWORD='$password' pg_dump -U $username -h $host -p $port $database > $path";
    }

    public function recreateDatabaseCommand(): string
    {
        $username = $this->username();
        $host = $this->host();
        $port = $this->port();
        $database = $this->database();
        $password = $this->password();

        return "PGPASSWORD='$password' psql -U $username -d $database -h $host -p $port " .
            "-c 'alter schema public rename to public_tmp;' " .
            "-c 'create schema public;'";
    }

    public function restoreDatabaseCommand(string $path): string
    {
        $username = $this->username();
        $host = $this->host();
        $port = $this->port();
        $database = $this->database();
        $password = $this->password();

        return "PGPASSWORD='$password' psql  -U $username -h $host -p $port -d $database < $path" . " && " . $this->deleteTemporalSchemaCommand();
    }
    
    public function deleteTemporalSchemaCommand()
    {
        $username = $this->username();
        $host = $this->host();
        $port = $this->port();
        $database = $this->database();
        $password = $this->password();
    
        return "PGPASSWORD='$password' psql -U $username -d $database -h $host -p $port " .
        "-c 'drop schema public_tmp CASCADE;'";
    }
}
