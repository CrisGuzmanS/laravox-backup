# 🙉 LARAVOX BACKUP 

## 🙌 Description 

This library allows you to save the current state of your database and restore it. Even, you can name those backups to have a list of them.

this package is useful when you want to test a functionality that could fails and you want to restore the previous state when it was working fine easily using one command.

Already tested in:

Database | Version 
---------- | --------
MySQL    | ^10.1.48-MariaDB

---
**NOTE**

The database user must have permissions for:
* create the database
* delete the database

---

## 🙌 Installation steps

1. install the package: `composer require laravox/backup`

2. Add these commands in your `app/Console/Kernel.php` file:

`
protected $commands = [
        Laravox\Backup\Console\Commands\BackupCleanCommand::class,
        Laravox\Backup\Console\Commands\CommandsBackupStoreCommand::class,
        Laravox\Backup\Console\Commands\CommandsBackupRestoreCommand::class,
        Laravox\Backup\Console\Commands\BackupCleanCommand::class,
    ];
`

## 🙌 Commands available

`php artisan backup:store`

it saves the current state of your database with your `APP_NAME` variable in your .env file

`php artisan backup:store {name}`

it does the same than the previous command, but stores the file with the {name} typed.

`php artisan backup:restore`

restore the database stored with the `APP_NAME` variable in your .env file

`php artisan backup:restore {name}`

restore the database stored with the `{name}`

`php artisan backup:list`

it shows a list of the backup stored with its names


## 🙌 What's next?

1. Overwrite the database completely. When you run a migration and you restore the database, the tables created in the migration are still alive, and this behavior should not occurs.

1. Allows to clean (or remove) and specific file using the {name} parameter.

1. the backup:list should not shows the extension '.sql'