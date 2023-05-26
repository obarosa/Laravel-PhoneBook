# Laravel-PhoneBook
Portal for managing contacts made with Laravel and JavaScript.

## Installation
### Step 1
Extract
### Step 2
Make sure to have Composer and NPM installed, updated & dev.
### Step 3
#### Create .env file
You have a example on env.example file.
#### Generate key
php artisan key:generate
#### Create DB
Create a DB called "phonebook" and then migrate: php artisan migrate (if you want to configure the DB name and other setting, go to .env file).
### Step 4
#### Dashboard login:
Email: admin@admin.pt
Password: 123456789
### Step 5
php artisan db:seed , to generate random Contacts.
### Step 6
Enjoy.

## Other
### Import
To import contacts from a CSV or XLSX file, go to the dashboard and click on the "Import" button. In the "dados" folder there are sample files.
