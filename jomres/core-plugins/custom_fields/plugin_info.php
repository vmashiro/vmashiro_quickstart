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

class plugin_info_custom_fields
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"custom_fields",
			"marketing"=>"Adds a new button to the administrator control panel which creates custom fields which are added to the booking form.",
			"version"=>(float)"2.2",
			"description"=> " Adds a new button to the administrator control panel which creates custom fields which are added to the booking form.",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/18-control-panel/developer-tools/145-custom-fields',
			'change_log'=>' 1.1 updated for use in v5.6 1.2 updated to work with Jr7.1 1.3 Jr7.1 specific changes v1.4 Minor tweak to ensure that editing mode does not interfere with buttons. v1.5 Removed references to Token functionality that is no longer used. v1.6 Removed references to Jomres URL Token function. v1.7 A variety of changes relating to v7.4 changes to property type relationships. v1.8 Hide menu option if Simple Site Config enabled. v1.9 Reordered button layout. v2.0 Added changes to reflect addition of new Jomres root directory definition. v2.1 Improved how toolbar is constructed in Joomla. v2.2 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'',
			'demo_url'=>''
			);
		}
	}
?>