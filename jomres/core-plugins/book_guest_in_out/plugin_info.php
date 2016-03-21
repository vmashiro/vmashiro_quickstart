<?php
/**
* Jomres CMS Agnostic Plugin
* @author Woollyinwales IT <sales@jomres.net>
* @version Jomres 9 
* @package Jomres
* @copyright	2005-2015 Woollyinwales IT
* Jomres (tm) PHP files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project.
**/


// ################################################################
defined( '_JOMRES_INITCHECK' ) or die( '' );
// ################################################################

class plugin_info_book_guest_in_out
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"book_guest_in_out",
			"marketing"=>"Adds new functionality to the List Bookings page, allowing the property manager to book guests in and out. This is useful if you're using Jomres as a Property Management System.",
			"version"=>(float)"2.5",
			"description"=> "Allows the property manager to book guests in and out of the property.",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/property-managers-guide/41-your-toolbar/bookings/219-list-bookings',
			'change_log'=>'1.1 Added some new language definitions to handle new book guest in/out language strings in the next version of Jomres. 1.2 Updated to add a menu option to Jomres 6 mainmenu. 1.3 updated output vars for template 1.4 Variety of changes to prevent var not set notices. 1.5 updated to work with Jr7.1 1.6 v7.1 specific changes. v1.7 Added a missing jr_gettext for the popup on bookout. v1.8 Removed references to Token functionality that is no longer used. v1.9 Added code supporting new Array Caching in Jomres. v2.0 Changed menu allocations and stopped deletion from room bookings table on bookout. v2.1 Reordered button layout. v2.2 Added functionality to support new Jomres management view code. v2.3 FSimplified the book/check in/out feature, Booking in/out is done through the list bookings page now. v2.5 Added ability to undo check in/out. v2.5 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/non-joomla/plugin_list/plugin_images/book_guest_in_out.png',
			'demo_url'=>'http://userdemo.jomres.net/index.php?option=com_jomres&Itemid=103&lang=en&task=list_bookings'
			);
		}
	}
?>