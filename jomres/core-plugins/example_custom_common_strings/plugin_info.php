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

class plugin_info_example_custom_common_strings
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"example_custom_common_strings",
			"version"=>(float)"0.2",
			"description"=> "This plugin is designed to demonstrate how strings can be added to the Common Strings array in Jomres, which can then be used in any template without any additional coding. Open j00005example_custom_common_strings.class.php in /jomres/core-plugins/example_custom_common_strings and read the comments in that file to understand how to use this plugin.",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/315-example-custom-common-strings',
			'change_log'=>'v1.2 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/manual/images/Manual/C__Users_Vince_Desktop_Jomres_Plugins_cms_agnostic_example_custom_common_strings_j00005example_custom_common_strings.class.php_-_Notepad%2B%2B_cmo6u.png',
			'demo_url'=>''
			);
		}
	}
?>