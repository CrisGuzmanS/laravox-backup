<?php

namespace Laravox\Backup\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BackupListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the list of all backups';

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

        foreach ($this->filenames() as $filename) {
            $this->info($filename);
        }


        return 0;
    }

    private function filenames(): array
    {
        $filenames = [];
        foreach ($this->files() as $file) {
            $filenames[] = $file->getFilename();
        }
        return $filenames;
    }

    private function files(): array
    {
        return File::allFiles($this->path());
    }

    private function path(): string
    {
        return storage_path('app/database/backups');
    }
}
