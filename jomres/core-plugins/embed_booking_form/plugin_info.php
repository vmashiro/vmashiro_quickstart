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

class plugin_info_embed_booking_form
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"embed_booking_form",
			"marketing"=>"Adds a menu option to the misc menu option to show managers embed code for embedding their booking form into an off-site page. Particularly useful if you're using Jomres as a portal.",
			"version"=>(float)"1.7",
			"description"=> " Adds a menu option to the misc menu option to show managers embed code for embedding their booking form into an off-site page. It is best that your site NOT be configured to show the booking form as a modal popup, for this to work best.",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/property-managers-guide/44-your-toolbar/misc/227-embed-booking-form',
			'change_log'=>'1.1 layout tweaks. 1.2 updated to work on Jr7 v1.3  Templates bootstrapped. 1.4 updated to work with Jr7.1. v1.5 Added BS3 templates. v1.6 Updated so that the property uid is shown in the embed code. v1.7 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/manual/images/Manual/All_Listings_-_Mozilla_Firefox_e1pye.png',
			'demo_url'=>'http://userdemo.jomres.net/index.php?option=com_jomres&Itemid=103&lang=en&task=embed_booking_form'
			);
		}
	}
?>