# First of All
 **ppl-app.**
 
 over-the-top app for software testing education purposes.
 
 over the top meaning all the files are all over the place on the top level directory. (*I'm sorry*).
 
 PPL (pee pee lowwer).
 
 I'm sure you already know what PP means. Lowwer means limp/limping.

 using PHPUnit Testing and XAMPP
 
 PHP, HTML, CSS
 no framework
 only hardwork
 
## What is this?
 ppl-app is a simple web application for account registration, account login, image upload and file (.pdf) upload.
 
 This app is developed with no framework.
 All files are on the top level directory.
 The naming of *some* files, however, is similar to how directories work.
 Assets are named `assets-...`.
 User uploads are stored right in the same directory with file name `user-...`
 
 The functions of this app are registration, login, logout, image upload, file upload.
 Admin can see the list of participants, their upload status, accept, reject and download participants' uploads.
 
 The flags attribute in the database is used for administration purposes so that the admin and competitor know what their status are.
 
 0 = no uploads;
 1 = file uploaded, awaiting review from admin;
 2 = file rejected by admin, user may re-upload;
 3 = file accepted by admin, user may upload again to overwrite the former file.
 
 The code is written not in an object-oriented way, so the test cases in `TestUnit.php` become very messy.
 
 Definitely not the best practices. Please don't be like me.
 
## Prerequisites
 1. A local server, with PHP and MySQL included. Preferably XAMPP for ease of use.
 2. PHP version 7.3x or 7.4x, no other exception.
 3. PHPUnit version 9.x

## How to install?
 1. Find XAMPP installation with PHP version 7.3x or 7.4x at https://www.apachefriends.org/download.html and install it.
 2. XAMPP installation comes with PHPUnit version 3.x, so you will a more updated version. Download the latest version at https://phpunit.de/index.html.
 3. Move the downloaded `.phar` file to your `/xampp/php` directory.
 4. Find `phpunit.bat` and edit it. Update the line `"%PHPBIN%" "C:\xampp\php\phpunit" %*` to `"%PHPBIN%" "C:\xampp\php\phpunit.phar" %*`. (you may need to change the directory and/or the file name)
 Kudos to Jonathan (https://stackoverflow.com/questions/43188374/update-phpunit-xampp)

## How to run?
 *With your legs! Haha*
 
 First thing first, you'll want to open XAMPP Control Panel and keep Apache and MySQL running.

### Running the webpage
 1. Make sure you place this repo inside the `/xampp/htdocs` directory.
 2. Open your web browser and go to `localhost/ppl-app`.
 3. To have it working properly, you need to create the database in MySQL by going to `localhost/phpmyadmin`.
 4. Create new database and name it `ppl_data`.
 5. Create new table and name it `competitors` with 9 columns which is (int)`id` (AUTO_INCREMENT, Primary Key), (varchar)`email` (realistically should be primary key, but not in this case), (varchar)`password`, (varchar)`name`, (varchar)`company`, (varchar)`photo_url`, (int)`photo_flag`, (varchar)`file_url`, (int)`file_flag`.
 6. And there you have it. The app working and well.
 7. To check on the admin page, go to `localhost/ppl-app/admin.php`.

### Running the tests
 1. Open your command prompt as admin and navigate to `/xampp/htdocs/ppl-app`.
 2. Enter command `phpunit TestUnit.php`
