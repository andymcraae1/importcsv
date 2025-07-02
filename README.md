# Import CSV
An application that allows CSV files to be imported into a MYSQL database. Written in Bootstrap, PHP, JQuery and ajax
## Why use Import CSV
- [x] It is dramatically faster than tools such as MySQL Workbench and even PHPMyAdmin to import data into a MYSQL database
- [x] It has a very user-friendly interface. No unnecessary features, just what you need to import your data quickly
> [!NOTE]
> Tested in real-world conditions, this tool takes approx. 350 seconds to import a CSV file with 2 million records into MySQL, which is less than 6 minutes. In comparison, `PHPMyadmin` needs 5 hours and `MySQL Workbench` roughly 3 days.
## Screenshot 1 of the interface
![Example](https://github.com/andymcraae1/importcsv/blob/main/screenshots/Image_1.PNG)
## Screenshot 2 of the interface
![Example](https://github.com/andymcraae1/importcsv/blob/main/screenshots/Image_2.PNG)
## Example video on how to use it

![Example](https://github.com/andymcraae1/importcsv/blob/main/screenshots/process.gif)
> [!NOTE]
> This project is an improvement of [CSV import into MySQL with Ajax](https://www.webslesson.info/2019/11/csv-import-using-ajax-progress-bar-in-php.html). Many thanks to them. However, the project is not very functional for several use cases. This is why this current project exists

## Key improvements
- [x] Allows you to work (delete, select, add) on multiple tables in a database directly via a graphical interface.
- [x] Allows you to choose the CSV file delimiter. Previously, only `,` was possible and it was used as a constant.
- [x] Allows large files of up to millions of lines to be imported (tested with a 200 MB file containing 2.5 million lines). The previous project linked to did not allow more than a few thousand lines to be processed.
- [x] Allows the project to be placed on a web server with a small, simple login system, in which the password and user are entered manually into a ‘user’ table. With password encryption in (tiger 160.3) format.
- [x] Includes a logging system that returns an error visible to the user if something goes wrong during file import.
- [x] Includes a timer system that allows the user to see how long an import takes. Typically 400 seconds for a 200 MB file.
- [x] Includes a sample database that can be directly imported to PHPMyAdmin
> [!IMPORTANT]
>  You need to have a working apache environment with at least PHP and MYSQL installed (XAMPP for Ubuntu MAC and Windows or WAMP only for windows). And also have some basic knowledge about PHP, SQL databases and about how to work with php files via localhost folder (Or xampp/htdocs/.. folder).
>  Then You will need to redefine your database and tables in order for the application to work. Currently, we provide you with a dummy database `sample database/sample_database.sql` which you can import in your MYSQL server to see how it looks like. with host: `localhost` user: `root` pw: `empty`. The table fields must be then adapted to your needs under `ajax/upload.php` `ajax/import.php` `ajax/process.php` `connect.php` and `db_pdo_connection.php`.
> [!WARNING]
> Please note the following: If you use this application online, your web hoster must be able to use at least 1280M `ini_set("memory_limit", "1280M")`; otherwise large files cannot be loaded.

## Quick Start
### Works with Ubuntu / Windows / MAC
### Clone repository
```
git clone https://github.com/mmrad1/importcsv
```
### Steps to follow
1. Copy the project on your work environment (e.g. localhost)

2. Import the sample database `sample database/sample_database.sql` via PHPMyadmin. Update the field names to match your dataset. Adapt the host, database name, user and password, to match your credentials in the following files: `ajax/upload.php` `ajax/import.php` `ajax/process.php` `connect.php` and `db_pdo_connection.php`.
3. You will need to adapt the tables you want to modify in the `index.php` file
4. Enter a user `user_name` and password `password` in the modified format tiger 160,3 in the `users` table via PHPMyadmin. Use `$password = hash('tiger160,3', 'MyPassword');` to retrieve your password and put it in the password field
5. Then, start apache and head to localhost where the index.php file should be. And start using your application.
> [!WARNING]
> The application may not work on the first try. This may be mainly due to the necessary adaptation of your database fields and associated tables. It may also be due to the fields that will be imported via `import.php`. Make sure you match the fields you want to import in this file. Once this is done (it may take around 30 minutes if you know what you are doing), the application should work correctly and you will save a lot of time in the future.
