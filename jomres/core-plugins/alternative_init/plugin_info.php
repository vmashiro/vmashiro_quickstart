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

class plugin_info_alternative_init
	{
	function plugin_info_alternative_init()
		{
		$this->data=array(
			"name"=>"alternative_init",
			"version"=>(float)"1.4",
			"description"=> "Wordpress Alt Init. When Jomres starts it needs some information to be created before it will run. Jomres.php/j00030search.class.php will do this normally however there are times when you may want to run use Jomres functionality without actually running Jomres in the component area. In this case you can include the alt_init.php script included in this plugin. This will perform the required initialisation steps without actually running Jomres itself.",
			"lastupdate"=>"2015/11/13",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://manual.jomres.net/alternative_init.html?ms=BVEAAAAAAAASEEAQCA==&mw=MjQw&st=MA==&sct=MA==',
			'change_log'=>'v1.1 Improved functionality in Jomres to support WP, particularly session and dealing with asamodule.  v1.2 Added support for dynamic Jomres root directory. v1.3 updated to resolve an issue with currency display in shortcodes. v1.4 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'',
			'demo_url'=>''
			
			);
		}
	}
