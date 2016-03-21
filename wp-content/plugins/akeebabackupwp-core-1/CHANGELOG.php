<?php die(); ?>
Akeeba Backup for WordPress 1.6.4
================================================================================
# [HIGH] Language files processed by Transifex caused the language parser to throw errors

Akeeba Backup for WordPress 1.6.3
================================================================================
# [HIGH] Front-end backup URL was not working
# [MEDIUM] Some servers with problematic libcurl implementations are unable to use Dropbox API v2, always receiving an error message.
# [MEDIUM] Upload to OneDrive occasionally fails when their API doesn't report the folder creation correctly

Akeeba Backup for WordPress 1.6.2
================================================================================
# [HIGH] The plugin mistakenly requires PHP 5.4 or later when it runs just fine on PHP 5.3.3 or later

Akeeba Backup for WordPress 1.6.1
================================================================================
# [HIGH] Possible backup failure when the database being backed up is of a different type (e.g. PostgreSQL vs MySQL) than the one containing the backup profile configuration
# [LOW] PHP Warning during session save

Akeeba Backup for WordPress 1.6.0
================================================================================
! Front-end and remote backup features will be DISABLED if we detect an insecure Secret Word
+ Added textual output to ALICE so it could be included in support tickets
+ Automatically run ALICE if an error occurs during the last domain of a backup
+ Support for Amazon S3's Standard- Infrequent Access storage type
+ Akeeba Backup for WordPress will set its own tables to utf8mb4 if your WordPress installation has utf8mb4 enabled
~ More stable Site Transfer Wizard thanks to improved transfer chunk size calculations
# [MEDIUM] One Click Backup buttons wouldn't actually switch the backup profile
# [LOW] No Status displayed in the Latest Backup module for successful backups
# [LOW] Added workaround for untranslated text caused by disabled parse_ini_* functions
# [LOW] Fixed typo in ALICE
# [LOW] Site Transfer Wizard, bad performance of the test FTP/SFTP servers could lead to an instant error when accessing this feature
# [LOW] Someone who already knows your Secret Word can store XSS in the database if the remote backup is enabled and you're not using Joomla!'s or Admin Tools' .htaccess file (discovered by NCC Group)

Akeeba Backup for WordPress 1.5.3
================================================================================
+ One-click backup icons. Select which profiles to display as one-click icons in Akeeba Backup's control panel
+ More prominent site restoration and transfer instructions in the Manage Backups page
# [HIGH] Chunked upload to OneDrive would result in an error
# [HIGH] Only 5Mb would be transferred to Amazon S3 on some hosts with PHP compiled against a broken libcurl library; workaround applied.
# [HIGH] Multipart upload to S3 fails when the file size is an integer multiple of the chunk size
# [HIGH] Amazon S3 has a major bug with Content-Length on some hosts when using single part uploads. We are now working around it.
# [MEDIUM] Using "Manage remote files" in the Manage Backups page could mangle backup profiles under some circumstances
# [LOW] Extra databases definition page, trying to validate the connection without any information entered results in a success message
# [LOW] Fixed supplying additional Download ID directly from the Control Panel page
# [LOW] Fixed backing up multiple external folders

Akeeba Backup for WordPress 1.5.2
================================================================================
# [HIGH] Under rare circumstances temporary data could be committed to the database and break future backups.
# [HIGH] Amazon S3 has a major bug with Content-Length on some hosts when using multipart uploads. We are now working around it.
# [HIGH] Google Storage and DreamObjects would not work
# [HIGH] Upload to S3 would fail due to cacert.pem issues with some hosts and versions of PHP
# [HIGH] Upload to S3 would fail if a file was an integer multiple of the Amazon S3 chunk size (5242880)

Akeeba Backup for WordPress 1.5.2.b1
================================================================================
- Removed the "Upload to Amazon S3 (legacy API)" post-processing engine. Existing backup profiles will be automatically migrated to the "Upload to Amazon S3" engine.
+ Akeeba Backup will ask you to enter your Download ID before showing you available updates.
+ Akeeba Backup will ask you to run the Configuration Wizard when it detects it's necessary. One less thing for you to remember!
+ JSON API: Return an error if preflight configuration checks indicate a critical error (e.g. output directory not writeable)
+ "Exclude error logs" filter, enabled by default, to prevent broken backup archives when error logs change their size / are rotated while the backup is in progress
~ Desktop notifications are now optional. If you have already enabled them don't worry, they won't be disabled (your browser remembers the previous setting).
~ Improved layout for the Control Panel page
~ New icon colour palette for easier identification of the Control Panel icons
~ The profile ID is displayed in the profile selection drop-down
~ Manage Backups: "Part 00" would be displayed when there is just one backup part present. Button label changed to "Download".
~ Manage Backups: Simplified the page layout
~ ANGIE: Removed the confusing messages about restoring to a different site or PHP version
~ ANGIE: Simplified the final page ("Finished")
~ Remove the title from the popover tips
# [HIGH] No error thrown when the engine state cannot be saved while the backup is in progress
# [HIGH] The database storage option for the temporary data didn't work
# [LOW] The backup size would be inflated if "Upload each part immediately" is enabled and it takes multiple step to post process a single archive part

Akeeba Backup for WordPress 1.5.0 and 1.5.1
================================================================================
~ These versions were removed shortly after release due to high priority issues in the Amazon S3 API.

Akeeba Backup for WordPress 1.4.2
================================================================================
# [LOW] The Size in Manage Backups would be wrong as the last part's size was counted twice

Akeeba Backup for WordPress 1.4.1
================================================================================
! Problem with the display of language strings

Akeeba Backup for WordPress 1.4.0
================================================================================
! The minimum required PHP version is now 5.4.0
+ Automatically check the integrity of the backup archive (opt-in, please read the documentation)
# [HIGH] Front-end and CLI backup does not work when your database password or username contains a comma
# [HIGH] Misconfigured servers would set the Secure cookie flag on plain HTTP sites leading to 500 Invalid Token errors. Now the default cookie flags are worked around with extreme prejudice!
# [HIGH] Multipart ZIP archives were broken
# [MEDIUM] ANGIE: You could not override the ANGIE password in the Backup Now page
# [LOW] The SQL query would not be printed on database errors

Akeeba Backup for WordPress 1.3.4
================================================================================
~ ANGIE: Improve memory efficiency of the database engine
~ Switching the default log level to All Information and Debug
+ CORE version; ALICE, automated backup issue resolution
+ CORE version; CLI scripts to schedule backups and check for failed scheduled backups
+ CORE version; Import backups already on the server
+ CORE version; Additional archivers; Direct FTP, Direct SFTP, JPS, ZIP (via ZipArchive)
+ CORE version; Additional fine-tuning options
+ CORE version; Integrated restoration
+ CORE version; Send archives by Email, FTP, SFTP
+ Support utf8mb4 in CRON jobs
# [LOW] Desktop notifications for backup resume showed "%d" instead of the time to wait before resume
# [LOW] Push notifications should not be enabled by default
# [MEDIUM] Dropbox integration would not work under many PHP 5.5 and 5.6 servers due to a PHP issue. Workaround applied.
# [HIGH] Restoring on MySQL would be impossible unless you used the MySQL PDO driver

Akeeba Backup for WordPress 1.3.3
================================================================================
! Packaging error leading to immediate backup failure

Akeeba Backup for WordPress 1.3.2
================================================================================
+ Push notifications with Pushbullet
# [HIGH] ANGIE: Restoration may fail or corrupt text on some servers due to UTF8MB4 support

Akeeba Backup for WordPress 1.3.1
================================================================================
~ Updated Import from S3 to use the official Amazon AWS SDK for PHP
~ ANGIE (restoration script): Reset OPcache after the restoration is complete (NB! Only if you use ANGIE's Remove Installation Directory feature)
+ You can set the backup profile name directly from the Configuration page
+ You can create new backup profiles from the Configuration page using the Save & New button
+ Desktop notifications for backup start, finish, warning and error on compatible browsers (Chrome, Safari, Firefox)
+ UTF8MB4 (UTF-8 multibyte) support in restoration scripts, allows you to correctly restore content using multibyte Unicode characters (Emoji, Traditional Chinese, etc)
# [HIGH] Restoration might be impossible if your database passwords contains a double quote character
# [MEDIUM] (Pro) Dropbox and iDriveSync: could not upload under PHP 5.6 and some versions of PHP 5.5
# [MEDIUM] Immediate crash when the legacy MySQL driver is not available
# [MEDIUM] (Pro) OneDrive upload could fail in CLI CRON jobs if the upload of all parts takes more than 3600 seconds
# [MEDIUM] (Pro) Reupload from Manage Backups failed when the post-processing engine is configured to use chunked uploads
# [MEDIUM] Sometimes, usually after updating WordPress, you'd get a 403 access denied until you cleared browser cookies
# [LOW] White page when the ak_stats database table is broken
# [LOW] (Pro) Wrong link to Download ID instructions page

Akeeba Backup for WordPress 1.3.0
================================================================================
+ Warning with information and instructions when you have PHP 5.3.3 or earlier instead of crashing with a blank page
+ Warning if you have an outdated PHP version which we'll stop supporting soon
+ gh-28 Native Microsoft Live OneDrive support
# [MEDIUM] Cancelling the creation of a new backup profile could lead to server error
# [MEDIUM] Import from S3 didn't work correctly

Akeeba Backup for WordPress 1.2.2
================================================================================
+ Added "Apply to all" button in Files and Directories Exclusion page
# [HIGH] Missing interface options on bad hosts which disable the innocent parse_ini_file PHP function
# [HIGH] ANGIE (restoration): Some bad hosts disable the innocent parse_ini_file PHP function resulting in translation and functional issues during the restoration
# [MEDIUM] ANGIE for Wordpress: Site url was not replaced when moving to a different server
# [MEDIUM] Update notification not displaying on some sites (Pro)
# [MEDIUM] Core: quote and time settings parameters are not visible in the Core release
# [MEDIUM] Warning thrown when connecting to the database - Issue Ref gh-23
# [LOW] Clicking the Configure button in the Profiles page can lead to error 500 on hosts with GET query parameter name length limits
# [LOW] ANGIE for Wordpress: fixed changing Admin access details while restoring
# [LOW] On some hosts you wouldn't get the correct installer included in the backup
# [LOW] Pro: Updater doesn't work properly on PHP 5.6 - Issue Ref gh-22

Akeeba Backup for WordPress 1.2.1.2
================================================================================
# [HIGH] Core: the front-end backup was broken

Akeeba Backup for WordPress 1.2.1.1
================================================================================
~ Core: WordPress.org was sending out unnecessary files with the package

Akeeba Backup for WordPress 1.2.1
================================================================================
# [HIGH] Control Panel icons not shown on some extremely low quality hosts which disable the innocuous parse_ini_file function. If you were affected SWITCH HOSTS, IMMEDIATELY!
# [HIGH] Old PHP 5.3 versions have a bug regarding Interface implementation, causing a PHP fatal error

Akeeba Backup for WordPress 1.2.0
================================================================================
~ New icon set in the main page
+ Now supports WordPress Multisite for restoration on new servers (you have to keep the same subdomain or subdirectory layout for your multisites)
# [HIGH] Javascript conflict with some plugins
# [LOW] Upload to Dropbox may not work on servers without a global cacert.pem file

Akeeba Backup for WordPress 1.2.0.rc5
================================================================================
! DirectoryIterator::getExtension is not compatible with PHP 5.3.4 and 5.3.5
- Removed the (broken) multipart upload from the legacy S3 post-processing engine. Please use the new "Upload to Amazon S3" option for multipart uploads.
# [HIGH] Bug in third party Guzzle library causes Amazon S3 multipart uploads of archives larger than the remaining RAM size to fail due to memory exhaustion.
# [HIGH] ANGIE for WordPress: The .htaccess was broken on restoration due to two typos in the code
# [MEDIUM] Fatal error on sites with open_basedir restrictions on the site's root

Akeeba Backup for WordPress 1.2.0.rc4
================================================================================
# [LOW] 500 error on some sites after updating to version 1.2

Akeeba Backup for WordPress 1.2.0.rc3
================================================================================
! Core version on WordPress.org had filenames in lowercase instead of uppercase, leading to immediate error loading the plugin

Akeeba Backup for WordPress 1.2.0.rc2
================================================================================
! Wrongly tagged Core version on WordPress.org

Akeeba Backup for WordPress 1.2.0.rc1
================================================================================
+ New and improved backup engine
+ ANGIE for WordPress: Update serialised data on restoration
+ ANGIE: Add warning about Live site URL on Windows
+ You can now sort and search records in the Profile Management page
~ Workaround for magic_quotes_gpc under PHP 5.3
~ Changed the .htaccess files to be compatible with Apache 2.4
~ Improved responsive display without cutting off the right side of the plugin's display
~ Layout tweaks in the Configuration page
# [HIGH] Magic quotes on PHP 5.3 could cause problems in filter pages
# [HIGH] [PRO] Update information not fetched unless you manually retry through the Update page
# [HIGH] [PRO] Akeeba Backup for WP Professional doesn't update correctly
# [MEDIUM] ANGIE: The option "No auto value on zero" was not working
# [MEDIUM] The data file pointer can be null sometimes when using multipart archives causing backup failures
# [MEDIUM] Upload to remote storage from the Manage Backups page was broken for Amazon S3 multipart uploads
# [MEDIUM] Race condition could prevent the reliable creation of JPS (encrypted) archives
# [LOW] ANGIE: Fixed table name abstraction when no table prefix is given
# [LOW] ANGIE: Fixed loading of translations
# [LOW] ANGIE for WordPress: The blog name and tagline were empty when restoring to a new server (thanks Dimitris!)
# [LOW] Workaround for badly written Wordpress plugins that are killing the request
# [LOW] Javascript errors in WP 4.0 due to subtle changes in script load order
# [LOW] Huge logo appearing on the page when WordPress debug mode is enabled
# [LOW] SFTP post-processing engine did not mark successfully uploaded backup as Remote
# [LOW] SFTP post-processing engine could not fetch the archive back to the server
# [LOW] Tooltips not showing for engine parameters when selecting a different engine (e.g. changing the Archiver Engine from JPA to ZIP)

Akeeba Backup for WordPress 1.1.5
================================================================================
# [HIGH] The integrated restoration is broken after the last security update

Akeeba Backup for WordPress 1.1.4
================================================================================
! [SECURITY: Medium] Possibility of arbitrary file writing while a backup archive is being extracted by the integrated restoration feature

Akeeba Backup for WordPress 1.1.3
================================================================================
! White page under certain versions of PHP

Akeeba Backup for WordPress 1.1.2
================================================================================
! Backup failure on certain Windows hosts and PHP versions due to the way these versions handle file pointers
! Failure to post-process part files immediately on certain Windows hosts and PHP versions due to the way these versions handle file pointers
# [HIGH] Translations wouldn't load
# [LOW] Exclude non-core tables button not working in database table exclusion page
# [LOW] Possible white page if you have are hosting multiple Akeeba Backup installations on the same (sub)domain

Akeeba Backup for WordPress 1.1.1
================================================================================
! Dangling file pointer causing backup failure on certain Windows hosts
~ CloudFiles implementation changed to authentication API version 2.0, eliminating the need to choose your location
~ Old MySQL versions (5.1) would return randomly ordered rows when dumping MyISAM tables when the MySQL database is corrupt up to the kazoo and about to come crashing down in flames
# [LOW] Database table exclusion table blank and backup errors when your db user doesn't have adequate privileges to show procedures, triggers or stored procedures in MySQL
# [LOW] Could not back up triggers, procedures and functions

Akeeba Backup for WordPress 1.1.0
================================================================================
+ Support for iDriveSync accounts created in 2014 or later
+ A different log file is created per backup attempt (and automatically removed when the backup archives are deleted by quotas or by using Delete Files in the interface)
+ You can now run several backups at the same time
+ The minimum execution time can now be enforced in the client side for backend backups, leading to increased stability on certain hosts
+ Back-end backups will resume after an AJAX error, allowing you to complete backups even on very hosts with very tight resource usage limits
+ The Dropbox chunked upload can now work on files smaller than 150Mb and will work across backup steps, allowing you to upload large files to Dropbox without timeout errors
+ Backups resulting in an AJAX error will be retried, in case backup failure was caused by a temporary server or network issue
+ Workaround for missing jQuery (old versions of WordPress or plugins corrupting jQuery loading in wp-admin)
+ Greatly improve the backup performance on massive tables as long as they have an auto_increment column
+ Work around the issues caused by some servers' error pages which contain DOM-modifying JavaScript
+ Work around for the overreaching password managers in so-called modern browsers which fill irrelevant passwords in the configuration page.
# [HIGH] Dropbox upload would enter an infinite loop when using chunked uploads
# [HIGH] Potential information leak through the JSON API using a Decryption Oracle attack
# [MEDIUM] Core version: missing remote backup feature
# [MEDIUM] Notice thrown from AppConfig.php
# [MEDIUM] ANGIE: Restoring off-site directories would lead to errors
# [LOW] ANGIE for WordPress, phpBB and PrestaShop: escape some special characters in passwords
# [LOW] Some language strings inherited from Akeeba Backup for Joomla! reference Joomla! instead of WordPress

Akeeba Backup for WordPress 1.0.6
================================================================================
! [HIGH] Information disclosure through the JSON API. This is a theoretical attack since we determined it is impractical to perform outside a controlled environment.
# [HIGH] Front-end backup wasn’t included in the Core version.

Akeeba Backup for WordPress 1.0.5
================================================================================
# [HIGH] Apparently the SVN issue causing the packaging problem with 1.0.2, 1.0.3 and 1.0.
4 is still unresolved and we still get white pages for some Professional features. We now
reset the SVN repository, hoprefully fixing the issue.

Akeeba Backup for WordPress 1.0.4
================================================================================
# [HIGH] Packaging error leads to error pages when trying to access Professional features
from the Core release.

Akeeba Backup for WordPress 1.0.3
================================================================================
! [HIGH] Packaging error leading to fatal error (white page)

Akeeba Backup for WordPress 1.0.2
================================================================================
# [HIGH] Leftover jQuery files from 1.0.b2 and earlier would be loaded in the stable release
# [HIGH] Missing Javascript file errors when WordPress' debug mode is enabled
# [HIGH] [PRO] ANGIE: restoring off-site directories leads to unworkable permissions (0341) in their subdirectories due to a typo

Akeeba Backup for WordPress 1.0.0
================================================================================
# [HIGH] WordPress Plugins page would report the Core version as an update to the Professional release, leading to loss of functionality

Akeeba Backup for WordPress 1.0.b4
================================================================================
~ Reorganised JS and CSS loading to use WordPress' semantics
# [MEDIUM] Update page would always report that the PHP version is too old and refuse to update

Akeeba Backup for WordPress 1.0.b3 - 2014/05/05
================================================================================
! Configuration file changed from config.json to config.php – expect some turbulence after update
+ You can now change the date/time format for the Start column in the Manage Backups page
+ Support restoration of "split URL" WordPress sites (site root and WordPress root being different directories)
+ Basic support for WordPress Multisite: multisite installations can be backed up only by the network admin and can only be restored on the same server / URL as the original blog network
~ Much improved database installer / updater
~ Use WordPress' timezone instead of asking you to specify it manually
~ Update notifications are performed using AJAX to prevent a connection timeout from making Akeeba Backup for WordPress inaccessible
# [HIGH] CLI scripts not working when the wp-config.php file is above the site's root
# [HIGH] Fatal error when the session path is not writeable
# [MEDIUM] The entire backup output folder was excluded from the backup, breaking Akeeba Backup when restored from a backup
# [MEDIUM] It wasn't possible to link to Dropbox
# [LOW] Sometimes the ANGIE password warning would appear without a password having been set
# [LOW] The profile selection box wouldn't show in the Backup Now page
# [LOW] The remote file management button in Manage Backups page doesn't open the interface in a pop-up as it should be

Akeeba Backup for WordPress 1.0.b2 - 2014/04/01
================================================================================
! Wrong name of Awf/Adapters/Curl.php file led to fatal error on some hosts
~ Enable debug mode when WordPress' debug mode (WP_DEBUG) is enabled
# [LOW] Download through browser warning showing \n instead of newlines
# [LOW] Beta version shown with an ALPHA badge

Akeeba Backup for WordPress 1.0.b1 - 2014/04/01
================================================================================
! First public release