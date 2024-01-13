# 🙉 LARAVOX BACKUP 

## 🙌 Description 

This library enables you to save and restore the current state of your database, allowing you to name and organize these backups for easy reference. The package proves particularly valuable when testing a functionality that may encounter failures, providing a straightforward command to effortlessly revert to a previously stable state when needed.

Already tested in:

| Database | Version          |
| -------- | ---------------- |
| MySQL    | ^10.1.48-MariaDB |
| Postgres | ^12.0            |

---
**NOTE**

The database user must have permissions for:
* create the database
* delete the database

---

## 🙌 Installation steps

1. install the package.
```composer
composer require laravox/backup
```

2. Add the BackupServiceProvider in your `config/app.php`:
```php
'providers' => [
    //...
    Laravox\Backup\BackupServiceProvider::class,
]
```

## 🙌 Commands available

__NOTE:__ all files are stored in `storage/app/database/backups/`

1. Store the backup:

```bash
php artisan backup:store
```

it saves the current state of your database using the `APP_NAME` variable in your .env file as the name of the backup. That means: `<APP_NAME>.sql`

2. Store the backup with an specific name:

```bash
php artisan backup:store {name}
```

3. restore the backup

it does the same than the previous command, but stores the file with the {name} typed.

```bash
php artisan backup:restore
```

4. Restore the backup with an specific name:

restore the database stored with the `APP_NAME` variable in your .env file

```bash
php artisan backup:restore {name}
```

5. List all backups:

restore the database stored with the `{name}`

```bash
php artisan backup:list
```

6. Delete all backups:

it shows a list of the backup stored with its names

```bash
php artisan backup:delete --all
```

Delete all backups


## 🙌 What's next?

1. Allows to delete an specific file using the {name} parameter.

1. the backup:list should not shows the extension '.sql'