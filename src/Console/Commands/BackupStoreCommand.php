<?php

namespace Laravox\Backup\Console\Commands;

use Illuminate\Console\Command;
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
        $password = $this->password();
        $database = $this->database();
        $path = $this->path();
        $name = $this->name();

        Storage::makeDirectory($this->path());

        shell_exec(
            "mysqldump -u $username -p$password $database > $path/$name.sql"
        );

        return 0;
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
