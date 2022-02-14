<?php

namespace Laravox\Backup\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BackupDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:delete {--A|all} {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the list of all backups';

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
        if($this->option('all')){
            File::cleanDirectory($this->path());
        }
        return 0;
    }

    public function path(): string
    {
        return storage_path("app/database/backups");
    }
}
