# xlsx-import
Importing Xlsx file with huge data using laravel framework

This is an example of importing xlsx file with 100K records in database and after importing you receive an email with number of imported records and number of rejected records

`composer install`  

#### Steps:
1- Set .env file  
2- Set values of Mail configurations in .env  
3- `php artisan queue:table`  
4- `php artisan migrate --path=database\migrations\2020_06_03_203905_create_jobs_table.php`  
5- `php artisan migrate --path=database\migrations\2020_06_02_193158_create_citizens_table.php`  
6- `php artisan queue:listen`



### Notes:
Usesd composer package : https://packagist.org/packages/maatwebsite/excel  
Documentation: https://docs.laravel-excel.com/3.1/getting-started/  
