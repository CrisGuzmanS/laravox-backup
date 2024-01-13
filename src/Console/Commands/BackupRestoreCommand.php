<?php

namespace Laravox\Backup\Console\Commands;

use Illuminate\Console\Command;
use Laravox\Backup\Strategies\StrategyFactory;

class BackupRestoreCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backuppy:restore {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore the entire database';

    /**
     * Strategy selected to do the command
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

        $this->strategy = (new StrategyFactory)
            ->handle(getenv("DB_CONNECTION"));
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        shell_exec(
            $this
                ->strategy
                ->recreateDatabaseCommand($this->path())
        );

        shell_exec(
            $this
                ->strategy
                ->restoreDatabaseCommand($this->path())
        );
        return 0;
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
