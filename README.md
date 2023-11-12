
# CR-Inventory

This is a simple inventory management system built using Laravel framework. Main features are:

1. Client Management (including birthday listing and sms sending)
2. Service Management
3. Sales (eg. keeping record when a client purchases a service)
4. Product Management (including category and brand management)
5. Inventory/Stock Management (Stock-in, Stock-out, current stock, expiry date management etc)
6. Statistics/report
7. Dashboard
8. Authentication

## Requirements

1. PHP 8.1+
2. Composer
3. NPM
4. MySQL/MariaDB

## Installation

Download/clone this repository and then run ```composer install```. Change configuration if required (as per Laravel doc). Create a new database, configure .env file and run migration ```php artisan migrate```. 
If you want to populate some fake/dummy data, we have following seeder classes:

1. UserSeeder (for inserting some users, you can use that for login).
2. ClientSeeder
3. ProductSeeder
4. ServiceSeeder

Run these seeders using artisan command. Eg. 
```php artisan db:seed --class=UserSeeder```


## License

The CR-Inventory is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
