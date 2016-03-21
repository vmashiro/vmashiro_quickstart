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

class plugin_info_template_editing
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"template_editing",
			"marketing"=>" Adds a new button to the administrator's control panel, allowing them to edit templates via the UI and save changes to the d/b, making their template changes upgrade safe.",
			"version"=>(float)"2.4",
			"description"=> " Adds a new button to the administrator's control panel, allowing them to edit templates via the UI and save changes to the d/b, making their template changes upgrade safe. ",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/18-control-panel/developer-tools/147-template-editing',
			'change_log'=>'1.1 Modified javascript to make it compatible with v5.2, this plugin requires Jomres v5.2beta2 or greater. 1.2 updated for use in v5.6. 1.3 Tidied up layout to work with the 5.6 control panel changes. 1.4 updated to work with Jr7.1 1.5 Jr7.1 specific changes. v1.6 modified feature to adapt to Jomres 7.2\'s property type specific template handling. v1.7 Improved handling of css files. v1.8 tweaked script to replace some textarea output when showing the original template. If < x > is not added then the editor area will not render properly. v1.9 ensured that < x > is removed properly when saving contact owner template. v2 Added a check for Joomla 3.1 v2.1 Removed references to Token functionality that is no longer used. v2.1 Added Joomla 3.2 specific code. v2.2 Reordered button layout. v2.3 Added changes to reflect addition of new Jomres root directory definition. v2.4 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/manual/images/Manual/Jomres_Portal_Quickstart_-_Administration_-_Jomres_-_Mozilla_Firefox_0s3dl.png'
			);
		}
	}
?>