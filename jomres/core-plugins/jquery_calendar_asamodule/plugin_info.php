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

class plugin_info_jquery_calendar_asamodule {
	function __construct()
		{
		$this->data=array(
			"name"=>"jquery_calendar_asamodule",
			"marketing"=>"Allows you to create a module to display a date picker in a module position.",
			"version"=>(float)"1.1",
			"description"=> " Allows you to create a module to display a date picker in a module position. Set the asamodule task to 'jquery_calendar_asamodule' and the arguments to '&property_uid=N' where N is the property uid of the property who's booking form you want to direct the user to.",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/73-jquery-calendar-asamodule',
			'change_log'=>'v1.1 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'',
			'demo_url'=>''
			);
		}
	}
?>