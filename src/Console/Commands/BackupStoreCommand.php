<?php

namespace Laravox\Backup\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BackupStoreCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:store {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the entire database';

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
        $username = $this->username();
        $host = $this->host();
        $port = $this->port();
        $password = $this->password();
        $database = $this->database();
        $path = $this->path();
        $name = $this->name();

        $this->createDirectoryIfNotExist();

        if ($this->connection() == 'mysql') {
            shell_exec(
                "mysqldump -u $username -p$password $database > $path/$name.sql"
            );
        } else if ($this->connection() == 'pgsql') {
            shell_exec(
                "PGPASSWORD='$password' pg_dump -U $username -h $host -p $port $database > $path/$name.sql"
            );
        } else {
            throw new Exception("Connection don't supported");
        }

        return 0;
    }

    private function createDirectoryIfNotExist()
    {
        File::makeDirectory($this->path(), 0755, true, true);
    }

    private function name()
    {
        return $this->argument('name') ?? $this->database();
    }

    private function connection()
    {
        return getenv("DB_CONNECTION");
    }

    private function database()
    {
        return config('database.connections.' . $this->connection() . '.database');
    }

    private function password()
    {
        return config('database.connections.' . $this->connection() . '.password');
    }

    private function username()
    {
        return config('database.connections.' . $this->connection() . '.username');
    }

    private function host()
    {
        return config('database.connections.' . $this->connection() . '.host');
    }

    private function port()
    {
        return config('database.connections.' . $this->connection() . '.port');
    }

    private function path()
    {
        return storage_path('app/database/backups');
    }
}
