# Computer Availability Map
A  work-in-progress computer availability map for my school's library.
The target machines are Windows.

## Installing
- You must install/use a webserver with mysql installed.
- Create a database named `computer_availability`.
- Run the SQL query located in the `www/` folder on your mysql server with the `computer_availability` database selected. This is to create the tables.

- Within the `www/` folder, drop both files into your web directory.
- Adjust the `database.php` file to reflect your mysql credentials.

- Download and put the `hook scripts/` folder into the root of a flash drive or another portable drive.
- In each script (login, logout, shutdown), adjust the url to point to the statuschange.php file on the server you're hosting the `www` files. (eg. http://mywebsite.com/path/to/statuschange.php)
- If you don't care to hide the source of the perl scripts from the users, skip the next section.

- On the same computer, install cpan by installing Strawberry Perl and associated tools (http://strawberryperl.com/)
- After strawberry perl installation, search and execute the CPAN Client and input 'install PAR::Packer'
- Then you should run make.bat in the `hook scripts/` folder to create the executables.

- Take your flash drive to the target computer(s).
- Adjust the copyfiles.bat Drive (eg. Z: or C:) to your flash drive’s drive.
- Run the copyfiles.bat script to copy the files into the correct locations.
- Goto the start menu and type in `gpedit.msc`, then press enter when the application pops up.
- Click the `User Configuration/Windows Settings` navigational tab
- Double click `Scripts (Logon/Logoff)`.
- Double click `Logon`
- Press `Add...` -> `Browse...`.
- If there is a file named “login.pl” then continue, if not then drag the file `hook scripts/login.pl` into this directory.
- Select this file and press `OK` then `Apply`
- Repeat these relevant steps for Logoff.

## Usage
Goto `mywebsite.com/path/to/files/data.php`
You will see a list of computers, their availability and the date that the status was last updated.

## Note
You may not see the target computer(s) right away, they must be logged out of the current user after installing the hook scripts.

