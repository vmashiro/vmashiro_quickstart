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

class plugin_info_common_template_variables
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"common_template_variables",
			"marketing"=>"Administrator area functionality. Designed to show developers common strings that are available to all templates without needing to add them to the template's calling script.",
			"version"=>(float)"1.6",
			"description"=> "Designed to show developers common strings that are available to all templates without needing to add them to the template's calling script. Adds a menu option 'common strings' to the Developer section in the administrator area Jomres menu.",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/43-common-template-variables',
			'change_log'=>'1.1 updated to work with Jr7.1 1.2 v7.1 specific changes v1.3 Minor tweak to ensure that editing mode does not interfere with buttons. v1.4  Hide menu option if Simple Site Config enabled. v1.4 Added BS3 templates. v1.5 Added changes to reflect addition of new Jomres root directory definition. v1.6 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/manual/images/Manual/Jomres_Portal_Quickstart_-_Administration_-_Jomres_-_Mozilla_Firefox_p0l5x.png',
			'demo_url'=>''
			);
		}
	}
?>