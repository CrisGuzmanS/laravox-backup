<?php

namespace Laravox\Backup\Strategies;

class MysqlStrategy extends Strategy
{
    protected function database(): string
    {
        return config('database.connections.mysql.database');
    }

    protected function password(): string
    {
        return config('database.connections.mysql.password');
    }

    protected function username(): string
    {
        return config('database.connections.mysql.username');
    }

    protected function host(): string
    {
        return config('database.connections.mysql.host');
    }

    protected function port(): string
    {
        return config('database.connections.mysql.port');
    }


    public function recreateDatabaseCommand(): string
    {
        $username = $this->username();
        $host = $this->host();
        $port = $this->port();
        $password = $this->password();
        $database = $this->database();

        return "mysql "
            . "--user='$username' "
            . "--password='$password' "
            . "--database='$database' "
            . "--host='$host'"
            . "--port='$port'"
            . "--execute='DROP DATABASE $database; CREATE DATABASE $database;'";
    }

    public function restoreDatabaseCommand($path): string
    {
        $username = $this->username();
        $host = $this->host();
        $port = $this->port();
        $password = $this->password();
        $database = $this->database();
        return "mysql -u $username --port $port -h $host -p$password $database < $path";
    }

    public function storeBackupCommand(string $path): string
    {
        $username = $this->username();
        $host = $this->host();
        $port = $this->port();
        $password = $this->password();
        $database = $this->database();
        
        return "mysqldump -u $username --port $port -h $host -p$password $database > $path";
    }
}
