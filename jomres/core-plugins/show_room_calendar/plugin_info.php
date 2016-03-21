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

class plugin_info_show_room_calendar
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"show_room_calendar",
			"marketing"=>"A simple plugin for use by ASAModule that allows you to show a room calendar in a module position.",
			"version"=>(float)"1.1",
			"description"=> "Set your ASAModule task to show_room_calendar, then in the arguments set the an id like so : '&id=1'. This will allow you to show a specific rooms's calendar in the module position of your choice.",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/311-show-room-calendar',
			'change_log'=>'v1.1 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/manual/images/Manual/All_Listings_-_Mozilla_Firefox_p20to.png',
			'demo_url'=>''
			);
		}
	}
?>