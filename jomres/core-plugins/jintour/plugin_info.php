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

class plugin_info_jintour
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"jintour",
			"marketing"=>"Jintour offers the ability to upsell finite resources such as Ski rental at the time of booking. Alternatively you can create properties that ONLY offer Jintour resources, bypassing the room booking functionality altogether. ",
			"version"=>"8.1",
			"description"=> "Handles tour/resource booking creation and management functionality for items that are booked at the same time as a room/property is booked.",
			"author"=>"Vince Wooll",
			"authoremail"=>"sales@jomres.net",
			"lastupdate"=>"2016/01/20",
			"min_jomres_ver"=>"9.5.0",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/24-control-panel/portal-functionality/178-tour-activity-management',
			'change_log'=>'v7.2 improved layout of extras in booking form, added Kids prices to output that displays in property list prices. v7.3 Added a dashboard view of future Jintour bookings for the given property. v7.4 Fixed an edge case where javascript in the page could be broken by filtered out tours not showing in the manager tour list. v7.5 property registration templates improved. v7.6 updated templates to add approval warning. v7.7 PHP7 related maintenance. v7.8 Changed some forms to use JOMRES_SITEPAGE_URL_NOSEF instead of JOMRES_SITEPAGE_URL. v7.9 Added new functionality related to new Partner handling. v8.0 Added functionality that relates to new streamlined property creation functionality. v8.1 Disabled code that disables coupons, as that is available now to Jintour bookings.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/non-joomla/plugin_list/plugin_images/jintour.png',
			'demo_url'=>''
			);
		}
	}
?>