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

class plugin_info_microsoft_translator
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"microsoft_translator",
			"marketing"=>"This plugin allows you to import automatic machine translations from Microsoft's translation service. These can then be edited before saving, if you wish. Very useful as it lets you edit the automatic translation before you save it, which can save quite a bit of time as most of the work is done for you, all you need to do is check that it's valid (if you speak both languages) and click Save.",
			"version"=>"1.9",
			"description"=> "This plugin allows you to import automatic machine translations from Microsoft's translation service. These can then be edited before saving, if you wish. It requires that you register for the service, but information on how to do that is available on the new Microsoft Translation Settings page in the administrator area. This is still an experimental plugin, so feedback welcome folks.",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/22-control-panel/languages/167-microsoft-translator',
			'change_log'=>'v1.1 added jquery ui templates. v1.2 Minor tweak to ensure that editing mode does not interfere with buttons. v1.3 Removed references to Token functionality that is no longer used. v1.4 Hide menu option if Simple Site Config enabled. v1.5 Added BS3 templates. Ordered button layout. v1.6 Added changes to reflect addition of new Jomres root directory definition. v1.7 tidied up code to resolve issues with blank array keys preventing translations from saving. v1.8 Updated feature to take into account caching when saving translations. v1.9 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/manual/images/Manual/Jomres_Portal_Quickstart_-_Administration_-_Jomres_-_Mozilla_Firefox_ehoua.png',
			'demo_url'=>''
			);
		}
	}
?>