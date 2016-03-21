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

class plugin_info_optional_extras
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"optional_extras",
			"category"=>"Bookings Configuration",
			"marketing"=>"Adds a new button to the manager's toolbar, and allows the creation of various models of optional extras which are added to the booking form. These are upsold items that are offered in the booking form after the rooms have been selected.",
			"version"=>(float)"4.4",
			"description"=> " Adds a new button to the manager's toolbar, and allows the creation of various models of optional extras which are added to the booking form (e.g. bouquet on arrival). v5.5 changes to allow property managers to set an optional extra as selected in the booking form when the form opens. ",
			"lastupdate"=>"2016/02/16",
			"min_jomres_ver"=>"9.4.6",
			"manual_link"=>'http://www.jomres.net/manual/property-managers-guide/48-your-toolbar/settings/257-extras-admin',
			'change_log'=>'v4.0 Changed some forms to use JOMRES_SITEPAGE_URL_NOSEF instead of JOMRES_SITEPAGE_URL. v4.1 Added functionality that allows managers to make optional extras only available when X room types have already been selected. v4.2 minor tweak that swaps extra name and description when building a dropdown. v4.3 Added a fix for Jintour properties creating sql errors because they do not have any room types. v4.4 Added some minor improvements to searches for room types.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/non-joomla/plugin_list/plugin_images/optional_extras.png',
			'demo_url'=>'http://userdemo.jomres.net/index.php?option=com_jomres&Itemid=103&lang=en&task=viewproperty&property_uid=1'
			);
		}
	}
?>