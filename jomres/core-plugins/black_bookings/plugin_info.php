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

class plugin_info_black_bookings
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"black_bookings",
			"marketing"=>"Adds a new button to the receptionist's toolbar, allows receptionists and managers to black book rooms or properties out, making them unavailable for certain periods.",
			"version"=>(float)"3.3",
			"description"=> " Adds a new button to the receptionist's toolbar, allows receptionists and managers to black book rooms or properties out, making them unavailable for certain periods.",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/property-managers-guide/41-your-toolbar/bookings/217-black-bookings',
			'change_log'=>'v2.0 changed the order of days in the calendar. v2.1  Made changes in support of the Text Editing Mode in 7.2.6. v2.2 Removed references to Token functionality that is no longer used. v2.3 Removed references to Jomres URL Token function. v2.4 changed how text is rendered to enable translation of some strings. v2.5 Changed the menu allocation. v2.6 Reordered button layout. v2.7 fixed some variables so that the menu option is hidden from those who do not need to see it. v2.8 Added changes to reflect addition of new Jomres root directory definition. v2.9 Changed how the depature date is calculated. v3.0 Modified how queries are performed to take advantage of quicker IN as opposed to OR. v3.1 Improved a url used. v3.2 fixed an issue where when the next year was chosen, the To date would be reset to the current year. v3.3 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/non-joomla/plugin_list/plugin_images/black_bookings.png',
			'demo_url'=>'http://userdemo.jomres-demo.net/index.php?option=com_jomres&Itemid=103&task=listBlackBookings'
			);
		}
	}
?>