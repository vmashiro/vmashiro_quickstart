<?php
/**
* Jomres CMS Specific Plugin
* @author Woollyinwales IT <sales@jomres.net>
* @version Jomres 9 
* @package Jomres
* @copyright	2005-2015 Woollyinwales IT
* Jomres (tm) PHP files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project.
**/

// ################################################################
defined( '_JOMRES_INITCHECK' ) or die( '' );
// ################################################################

class plugin_info_jomres_search
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"jomres_search",
			"version"=>(float)"1.3",
			"description"=> 'Widget for Wordpress. Allows you to display a Jomres seach from in a widget.  ',
			"lastupdate"=>"2015/11/13",
			"min_jomres_ver"=>"9.2.1",
			"type"=>"widget",
			"manual_link"=>'',
			'change_log'=>'v1.1 Added a check for WPINC v1.2 PHP7 related maintenance. v1.3 Fixed an issue with headers being incorrect.',
			'highlight'=>'REQUIRES THE ALT INIT PLUGIN TO BE INSTALLED FIRST.',
			'image'=>'',
			'demo_url'=>''
			);
		}
	}
