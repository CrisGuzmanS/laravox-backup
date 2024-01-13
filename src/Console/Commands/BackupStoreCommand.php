<?php

namespace Laravox\Backup\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Laravox\Backup\Strategies\StrategyFactory;

class BackupStoreCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backuppy:store {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the entire database';

    /**
     * 
     * 
     */
    protected $strategy;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->strategy = (new StrategyFactory)->handle(getenv("DB_CONNECTION"));
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this
            ->createDirectoryIfNotExist();

        shell_exec(
            $this
                ->strategy
                ->storeBackupCommand($this->path())
        );

        return 0;
    }

    private function createDirectoryIfNotExist()
    {
        File::makeDirectory($this->directory(), 0755, true, true);
    }

    private function path()
    {
        return $this->directory() . "/" . $this->fileName() . ".sql";
    }

    private function fileName()
    {
        return $this->argument('name') ?? getenv("DB_DATABASE");
    }

    private function directory()
    {
        return storage_path('app/database/backups');
    }
}
