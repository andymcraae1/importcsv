# Import CSV
A tool for importing CSV files directly into MYSQL with bootstrap, PHP and ajax

## Screenshot 1 of the interface
![Screenshot of the interface](https://github.com/andymcraae1/importcsv/blob/main/screenshots/Image_1.PNG)

## Screenshot 2 of the interface
![Screenshot of the interface](https://github.com/andymcraae1/importcsv/blob/main/screenshots/Image_2.PNG)

> [!NOTE]
> This project is an improvement of [CSV import into MySQL with Ajax](https://www.webslesson.info/2019/11/csv-import-using-ajax-progress-bar-in-php.html).


## Key improvements
- [x] Allows you to work (delete, select, add) on multiple tables in a database directly via a graphical interface.
- [x] Allows you to choose the CSV file delimiter. Previously, only ‘,’ could be chosen.
- [x] Allows large files of up to millions of lines to be imported (tested with a 200 MB file containing 2.5 million lines). The previous project linked to did not allow more than a few thousand lines to be processed.
- [x] Allows the project to be placed on a web server with a small, simple login system, in which the password and user are entered into a ‘user’ table. With password encryption in (tiger 160.3) format.
- [x] Includes a logging system that returns an error visible to the user if something goes wrong during file import.
- [x] Includes a timer system that allows the user to see how long an import takes. Typically 400 seconds for a 200 MB file.
- [x] Includes a sample database that can be directly imported to PHPMyAdmin

> [!IMPORTANT]
>  You will need to redefine your database and tables in order for the application to work. Currently, it is connected with a dummy database called `my_database`, with host: `localhost` user: `root` pw: `empty`. The table fields must be adapted to your needs under `ajax/upload.php` `ajax/import.php` `ajax/process.php` `connect.php` and `db_pdo_connection.php`.
> 
> [!WARNING]
> Please note the following: If you use this application online, your ISP must be able to use at least 1280M ini_set(“memory_limit”, “1280M”); otherwise large files cannot be loaded.
