# 🙉 LARAVOX BACKUP 

## 🙌 Description 

This library allows you to save the current state of your database and restore it. Even, you can name those backups to have a list of the.

this package is useful when you want to test a functionality that could fails and you want to restore the previous state when it was working fine easily using one command.

## 🙌 Installation steps

1. install the package: `composer require laravox/backup`

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