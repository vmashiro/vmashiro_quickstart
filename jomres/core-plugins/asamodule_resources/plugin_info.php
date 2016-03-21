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

class plugin_info_asamodule_resources
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"asamodule_resources",
			"marketing"=>"Shows a property rooms/resources in an ASAModule widget/module. Useful for single property websites.",
			"version"=>(float)"1.3",
			"description"=> "Shows a property rooms/resources in an ASAModule widget/module. Use the argument 'asamodule_resources_puid' to set the property uid and 'asamodule_resources_ids' to set what rooms to show.",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"type"=>"",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/308-asamodule-resources',
			'change_log'=>'v1.3 PHP7 related maintenance.',
			'image'=>'',
			'demo_url'=>''
			);
		}
	}
