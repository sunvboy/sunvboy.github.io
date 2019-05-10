# PHPExport

In this project I show how to export data to MS Excel, a text file, or MS Word using PHP.

##PHPExport to Excel, Text Files, and Word

I built this example on WAMP but it can be used on any instance of a PHP/MySQL environment.

First run the CreateExportPHPDB.sql script in your MySQL instance.

This will create the database used by the application.

Then create a user dbuser with a password of dbuser, and give it rights to the database for select.

If you have another user/password you'd like to use then just change the credentials in DBConnect.php in the php directory of the application.

Then put the PHPExport directory in your localhost, navigate to it in the browser and open the index.php.
