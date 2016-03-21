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

class plugin_info_resource_features
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"resource_features",
			"marketing"=>"Allows the site admin to create room/resource features that can be assigned by managers to their rooms/resources and also allow managers to create their property specific room/resources features. Room/resource features are useful because if you enable the \"classic\" rooms list in the booking form then guests can search for rooms with specific features.",
			"version"=>(float)"2.2",
			"description"=> " Allows the site admin to create room/resource features that can be assigned by managers to their rooms/resources and also allow managers to create their property specific room/resources features.",
			"lastupdate"=>"2015/11/11",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/property-managers-guide/48-your-toolbar/settings/240-room-resource-features',
			'change_log'=>'v1.1 Improvements to Room feature editing for JQ UI based systems. v1.2 Added changes to reflect addition of new Jomres root directory definition. v1.3  Modified plugin to ensure correct use of jomresURL function. v1.4 BS3 template related changes. v1.5 Added new functionality that allows uploading of images for Optional Extras. v1.6 small performance improvements. v1.7 Improved how room features images are managed. v1.8  fixed a bug with images not showing when not logged in. v1.9 Removed template touchable code from j06002list_resource_features.class.php v2.0 added asamodule_resources to exception tasks. v2.1 PHP7 related maintenance. v2.2 Changed some forms to use JOMRES_SITEPAGE_URL_NOSEF instead of JOMRES_SITEPAGE_URL.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/manual/images/Manual/All_Listings_-_Mozilla_Firefox_1bekv.png',
			'demo_url'=>''
			);
		}
	}
?>