<?php

namespace Laravox\Backup;

use Illuminate\Support\ServiceProvider;
use Laravox\Backup\Console\Commands\BackupListCommand;
use Laravox\Backup\Console\Commands\BackupRestoreCommand;
use Laravox\Backup\Console\Commands\BackupStoreCommand;

class BackupServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                BackupListCommand::class,
                BackupRestoreCommand::class,
                BackupStoreCommand::class,
            ]);
        }
    }
}
