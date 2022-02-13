<?php

namespace Laravox\Backup\Console\Commands;

use Illuminate\Console\Command;

class BackupRestoreCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:restore {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore the entire database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        shell_exec($this->recreateDatabaseCommand());
        shell_exec($this->restoreDatabaseCommand());
        return 0;
    }

    public function recreateDatabaseCommand(): string
    {
        $username = $this->username();
        $password = $this->password();
        $database = $this->database();

        return "mysql "
            . "--user='$username' "
            . "--password='$password' "
            . "--database='$database' "
            . "--execute='DROP DATABASE $database; CREATE DATABASE $database;'";
    }

    public function restoreDatabaseCommand(): string
    {
        $username = $this->username();
        $password = $this->password();
        $database = $this->database();
        $path = $this->path();
        $name = $this->name();
        return "mysql -u $username -p$password $database < $path/$name.sql";
    }

    private function name()
    {
        return $this->argument('name') ?? $this->database();
    }

    private function database()
    {
        return config('database.connections.mysql.database');
    }

    private function password()
    {
        return config('database.connections.mysql.password');
    }

    private function username()
    {
        return config('database.connections.mysql.username');
    }

    private function path()
    {
        return storage_path('app/database/backups');
    }
}
