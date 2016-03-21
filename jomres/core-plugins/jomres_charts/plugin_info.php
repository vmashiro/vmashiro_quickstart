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

class plugin_info_jomres_charts
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"jomres_charts",
			"marketing"=>"Adds more charts for admins and property managers.",
			"version"=>(float)"1.1",
			"description"=> "Adds more charts for admins and property managers.",
			"lastupdate"=>"2015/12/02",
			"min_jomres_ver"=>"9.4.-1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/327-jomres-charts',
			'change_log'=>'v1.1 added Property Visits chart to frontend to allow managers to see how many visits their property is getting.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/manual/images/Manual/All_Listings_-_Mozilla_Firefox_atl1a.png',
			'demo_url'=>''
			);
		}
	}
