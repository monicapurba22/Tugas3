Money Manager EX - WebApp
====================

The WebApp for Money Manager EX lets you insert new transactions from any device. You only need a web browser and an Internet connection to your webserver.

The webapp lets you save a &quot;transaction reminder&quot; with essential data, that you can reviewed later using the desktop version.

When you start up the desktop version of Money Manager EX, it downloads all transactions saved to the webapp. You can review them one by one. At the same time, the desktop version updates the webapp with any new payees or categories so they both stay in sync.</p>

## Server-side requirements

 * Webserver with PHP 5.4 or higher (tested on Apache, IIS and nginx)
 * PDO_SQLite extension (enabled by default on PHP 5.2 or higher)
 * Full rights on the WebApp subfolder

## Client-side requirements

 * Web browser fully compatible with HTML5
 * Optimized for portrait view on mobile device

## Recommendations

You can use WebApp on a shared hosting service to greatly simplify the installation process. Most free services meet the small requirements of the WebApp.

If you know what you are doing, you can install a webserver on your PC. After that you also need to properly configure your router to forward the webserver port and reach it with a static IP or DNS. You can find many guides for this on the web.

## How to install WebApp

### Traditional Way
 1. Unzip the latest version in a folder on your webserver or upload files through FTP.
 2. Rename `htaccess.txt` to `.htaccess` (on Windows type `.htaccess.` or use the Command Prompt and &quot;rename&quot; command).
 3. Enable PDO_SQLite if disabled.
 4. Open your browser to the folder URL.
 5. Fill in a username and password and review the settings.

### Docker Way 

Run the following commands after cloning this repo:

1. `docker build -t webmmx:latest .`

2. `docker run -d -p <your available port>:80 webmmx:latest`



The GUID for data sync with the desktop version is auto-generated. We suggest not changing it.

## Configure Desktop App

 1. Open desktop app.
 2. Options -> Network -> WebApp Settings.
 3. Fill in Url and GUID.
 4. Hit OK

## First run

 1. Open desktop app.
 2. Tools -> Refresh WebApp.
 3. Wait till it's over
 4. You're now ready to enter your first transaction.

## Upgrade

 1. Delete all files from webserver except for:
    * configuration_user.php
    * MMEX_New_Transaction.db
 2. Unzip all files in the same folder as the original installation.
 3. The first time you open the WebApp, it automatically upgrades the database to new version.
