<?php

namespace Laravox\Backup\Providers;

use Illuminate\Support\ServiceProvider;
use BackupCleanCommand;
use Laravox\Backup\Console\Commands\BackupListCommand;
use Laravox\Backup\Console\Commands\BackupRestoreCommand;
use Laravox\Backup\Console\Commands\BackupStoreCommand;

class BackupServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            BackupListCommand::class,
            BackupRestoreCommand::class,
            BackupStoreCommand::class,
        ]);
    }

    public function boot()
    {
    }
}
