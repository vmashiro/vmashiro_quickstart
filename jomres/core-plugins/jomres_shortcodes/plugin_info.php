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

class plugin_info_jomres_shortcodes
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"jomres_shortcodes",
			"version"=>(float)"1.4",
			"description"=> 'Plugin for Wordpress. Allows you to use Jomres shortcodes. See the manual for more information about these shortcodes. ',
			"lastupdate"=>"2015/11/13",
			"min_jomres_ver"=>"9.2.1",
			"type"=>"widget",
			"manual_link"=>'',
			'change_log'=>'v1.1 Added a check for WPINC v1.2 Fixed an issue in the plugin installer that prevented the plugin from being moved to its final resting place. v1.3 PHP7 related maintenance. v1.4 Fixed an issue with headers being incorrect.',
			'highlight'=>'REQUIRES THE ALT INIT PLUGIN TO BE INSTALLED FIRST.',
			'image'=>'',
			'demo_url'=>''
			);
		}
	}
