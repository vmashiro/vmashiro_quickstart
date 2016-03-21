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

class plugin_info_booking_enquiries
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"booking_enquiries",
			"marketing"=>"Adds functionality that allows property managers to approve bookings. When this functionality is enabled bookings don't immediately  block rooms. Instead the manager is given the opportunity to review the booking before approving it. Once the booking is approved the guest returns to the website by clicking a link and can proceed with paying for the booking.",
			"version"=>(float)"1.5",
			"description"=> " Adds functionality that allows property managers to approve bookings.",
			"lastupdate"=>"2015/11/11",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/36-booking-enquiries',
			'change_log'=>'v1.1 fixed a bug in one of the bootstrap 3 templates which caused patTemplate to complain about recursion. v1.2 Updated the jquery ui email approval template. v1.3 Added code specific to new commission functionality. v1.4 PHP7 related maintenance. v1.5 Changed some forms to use JOMRES_SITEPAGE_URL_NOSEF instead of JOMRES_SITEPAGE_URL.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/manual/images/Manual/All_Listings_-_Mozilla_Firefox_nsyoa.png',
			'demo_url'=>'http://userdemo.jomres.net/index.php?option=com_jomres&Itemid=103&lang=en&task=business_settings'
			);
		}
	}
?>