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

class plugin_info_contact_in_sidebar
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"contact_in_sidebar",
			"marketing"=>" Allows you to add a Contact Owner module to the sidebar using Jomres ASAModule.",
			"version"=>(float)"1.4",
			"description"=> " Allows you to add a Contact Owner module. Using JomresASAModule, set the task to \"contact_in_sidebar\". Developers, read the notes in /".JOMRES_ROOT_DIRECTORY."/core-plugins/contact_in_sidebar/j06000contact_in_sidebar.class.php as we explain in there a nice trick that can be used to briefly change the path to a template. ",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/44-contact-in-sidebar',
			'change_log'=>'v1.1 Added changes to use Jomres custom recaptcha language strings. v1.2  Added BS3 templates. v1.3 removed Title from template output. v1.4 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'',
			'demo_url'=>''
			);
		}
	}
?>