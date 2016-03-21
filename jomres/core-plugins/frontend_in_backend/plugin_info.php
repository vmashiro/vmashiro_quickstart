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

class plugin_info_frontend_in_backend
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"frontend_in_backend",
			"marketing"=>"An experimental plugin that allows us to perform property management in the administrator area.",
			"version"=>"1.5",
			"description"=> "An experimental plugin that allows us to perform property management in the administrator area. Requires Jomres 5.6.1 (specifically changeset 1765). Caveat : This is effectively a wrapper for the frontend, so to perform property management you must already be logged into the frontend via a user who is a property manager in the frontend.",
			"lastupdate"=>"2016/01/22",
			"min_jomres_ver"=>"9.5.0",
			'change_log'=>'v1.1 Hide menu option if Simple Site Config enabled. v1.2 Added functionality to support new Jomres management view code. v1.3 Added changes to reflect addition of new Jomres root directory definition. v1.4 PHP7 related maintenance. v1.5 Modal changed to use Bootstrap modals, not older jQuery UI modal. Much prettier and actually works.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/non-joomla/plugin_list/plugin_images/frontend_in_backend.png',
			'demo_url'=>'',
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/66-frontend-in-backend'
			
			);
		}
	}
?>