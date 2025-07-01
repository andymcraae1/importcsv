# Import CSV
A tool for importing CSV files directly into MYSQL

This project is an imporovement of [CSV import into MySQL with Ajax](https://www.webslesson.info/2019/11/csv-import-using-ajax-progress-bar-in-php.html).
## Key improvements
- [x] #739 Allows you to work (delete, select, add) on multiple tables in a database directly via a graphical interface.
- [x] Allows you to choose the CSV file delimiter. Previously, only ‘,’ could be chosen.
- [x] Allows large files of up to millions of lines to be imported (tested with a 200 MB file containing 2.5 million lines). The previous project linked to did not allow more than a few thousand lines to be processed.
- [x] Allows the project to be placed on a web server with a small, simple login system, in which the password and user are entered into a ‘user’ table. With password encryption in (tiger 160.3) format.
- [x] Includes a logging system that returns an error visible to the user if something goes wrong during file import.
- [x] Includes a timer system that allows the user to see how long an import takes. Typically 400 seconds for a 200 MB file.


> [!IMPORTANT]
> The index.php file allows for minimal table management. That is, viewing, deleting, and adding data to tables. You will need to add your database and connect the correct tables to the frontend file (). 

The database connection is currently db: `localhost` user: `root` pw: ``. If you choose to put your project online, you will obviously need to change the login details.
