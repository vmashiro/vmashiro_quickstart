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

class plugin_info_guest_types
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"guest_types",
			"category"=>"Property Manager tools",
			"marketing"=>"Adds a new button to the manager's toolbar which allows the creation of customer/guest types such as Adults and Children. This functionality allows you to offer different discounts for different guest types, so for example you can create a OAP (Old Age Pensioner. Is that still PC? I hope so) guest type and offer a percentage discount off the normal cost of a room.",
			"version"=>(float)"3.0",
			"description"=> " Adds a new button to the manager's toolbar which allows the administration of customer/guest types. This plugin is required if you want to charge per person per night.",
			"lastupdate"=>"2016/02/09",
			"min_jomres_ver"=>"9.5.6",
			"manual_link"=>'http://www.jomres.net/manual/property-managers-guide/48-your-toolbar/settings/255-guest-types',
			'change_log'=>'1.7 Modifications to bring plugin in line with Jr7.1 for SRPs and jquery ui templates. v1.8 Made changes in support of the Text Editing Mode in 7.2.6. v1.9 Removed references to Token functionality that is no longer used. v2.0 Removed references to Jomres URL Token function. v2.1  Added code supporting new Array Caching in Jomres. v2.2 Added BS3 templates. v2.3  Moved templates from core Jomres into plugin template dirs. v2.4 updated action toolbars. v2.5 Fixed issues with publish buttons and various template tweaks. v2.6 Jomres 8.1.4 adds the is_child flag to the customertypes table, this plugin updated to reflect that flag. v2.7 BS3 template related changes. v2.8 PHP7 related maintenance. v2.9 Changed some forms to use JOMRES_SITEPAGE_URL_NOSEF instead of JOMRES_SITEPAGE_URL. v3.0 Fixed a bug where posneg was saved incorrectly.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/non-joomla/plugin_list/plugin_images/guest_types.png',
			'demo_url'=>'http://userdemo.jomres.net/index.php?option=com_jomres&Itemid=103&lang=en&task=listCustomerTypes'
			);
		}
	}
?>