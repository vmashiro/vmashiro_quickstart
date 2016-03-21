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

class plugin_info_jomres_ical
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"jomres_ical",
			"marketing"=>"Adds ical import & export/feed functionality to Jomres.",
			"version"=>(float)"1.2",
			"description"=> "Adds ical support to Jomres. Allows for import of ics files, and exports both feeds and individual contracts. Feeds can be either anonymous or via a token which gives full information.",
			"lastupdate"=>"2015/01/19",
			"min_jomres_ver"=>"9.4.0",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/329-jomres-ical-plugin',
			'change_log'=>'v1.1 Added ability to import iCal files. v1.2 Considerably reworked the plugin. ',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/manual/images/Manual/All_Listings_-_Mozilla_Firefox_08929.png',
			'demo_url'=>''
			);
		}
	}
