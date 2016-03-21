<?php
/**
 * Plugin
 * @author Vince Wooll <sales@jomres.net>
 * @version Jomres 4 
* @package Jomres
* @copyright	2005-2010 Vince Wooll
* Jomres (tm) PHP files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project, and use it accordingly, however all images, css and javascript which are copyright Vince Wooll are not GPL licensed and are not freely distributable. 
**/

// ################################################################
defined( '_JOMRES_INITCHECK' ) or die( '' );
// ################################################################

define('_JOMRES_DATAWIPE_TITLE',"Data wipe");
define('_JOMRES_DATAWIPE_DESC',"This feature allows you to delete data that's collected when bookings are made. It is intended for use by developers who have created a lot of development data on their installations (such as test bookings, subscriptions) and want to wipe the information from the system, while maintaining property and tariff information.<br/> The plugin will remove ALL cron logs, user favourites, notes, bookings, invoices, subscribers, subscriptions, guests, audit data, click counts and reviews.");
define('_JOMRES_DATAWIPE_WARNING',"This data can only be retrieved from a backup copy of your system, so you need to understand that this is a very damaging script. As a result, it is recommended that once you have used it for it's intended purpose that you uninstall it again afterwards.");
define('_JOMRES_DATAWIPE_GO',"Click to wipe data");
define('_JOMRES_DATAWIPE_EMPTYING',"Emptying ");
define('_JOMRES_DATAWIPE_EMPTYING_SUCCESS',"Emptied successfully.");
define('_JOMRES_DATAWIPE_EMPTYING_FAILURE',"Failed to empty the table.");
?>