# appstage_assessment_js
The coding assessment presented to me by AppStage in order to showcase my PHP and SQL skills. 

This README explains the files associated with the project. 

The code presented is published and is currently live, and may be viewed and experienced at https://js-demonstration.000webhostapp.com/

Briefly, in order to test the package on a local machine, XAMPP is require to be installed. I reccomend the use of version 7.1.8 x86, as I made use of this version during this project, as I felt this version being more stable and keeping compatibility in mind should the client make use of older infrastructure (if the system is utilized on a local machine). A MySQL database was created and utilized in this project, which works smoothly with XAMPP 7.1.8, provided that the Apache and MySQL services are running. It is important to start these services before working with the application. 

Kindly follow the instructions below in order to make use of the application on a Windows system:

1) Navigate to https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.1.8/xampp-win32-7.1.8-0-VC14-installer.exe/download in order to start the download of XAMPP. Note that this version was used with the development and testing of my solution. 

2) Install the application and ensure to uncheck the "Learn more about Bitnami for XAMPP" option during installation. Once the setup is completed, check the box to start the Control Panel once “Finish” has been pressed. 

3) When instructed, choose the American flag option as it represents the language for the XAMPP interface. After selecting your desired language, the Control Panel window appears.
 
4) After XAMPP has been successfully installed, open the following file: C:\xampp\php\php.ini

5) Search the file for the second occurrence of ‘timezone’, which should be located on line 1957 in the text editor. Set the time zone to date.timezone=Africa/Johannesburg as this is imperative for the database system to operate in the correct time zone. 

6) Open the file C:\xampp\phpMyAdmin\config.inc.php in order to perform the following configuration:
    a) Set the ‘blowfish_secret’ option to a random 32-character string, as this specifies the encryption key for the authentication cookie.
    b) Set the ‘auth_type’ option to a value of ‘cookie’.
    c) Set the ‘user’ and ‘password’ options to empty strings.
    d) Save the changes made to the file. 
    
7) On the XAMPP control panel, press start for both Apache and MySQL services. This takes a few moments to activate these services. Once both modules are highlighted green, click on the “Admin” button of the MySQL service. This will launch a webpage on the localhost, which is hosted on the local system/network. The graphical user interface (GUI) will launch in the web browser. Login as ‘root’, but do not enter a password. This will navigate you to the Home page of phpMyAdmin.

8) On the left-hand side, click on “New”. This will enable you to create a new database. For this project, create the new database called “veterinary”.

9) Once the database has been created, import the pre-populated and configured database to the created database in phpMyAdmin. The import tab will be used to perform the import, which will enable you to select the “veterinary.sql” file. Be sure to uncheck the option “Enable foreign key checks” as it would prevent any unnecessary irregularities that may occur during import. Once the file has been selected from the directory and the foreign key checks are disabled, press “Go”. It will take a few moments for the queries to run by the SQL interpreter.

10) The code has been designed and developed to be easily deployed through the use of the htdocs directory located at C:\xampp\htdocs. The code can be taken from this source and directly placed into the htdocs directory. Be sure to remove the files present within the htdocs folder before deployment. 

Should you require any further assitance or guidance with regards to this package, kindly contact me at your earliest convenience. 

Thank you for your support! :)
