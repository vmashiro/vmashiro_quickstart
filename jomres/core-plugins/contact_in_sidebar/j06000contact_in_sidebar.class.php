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
defined( '_JOMRES_INITCHECK' ) or die( 'Direct Access to this file is not allowed.' );
// ################################################################

class j06000contact_in_sidebar
	{
	function __construct()
		{
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$ePointFilepath = get_showtime('ePointFilepath'); // Need to set this here, because the calls further down will reset the path to the called minicomponent's path.

		if (isset($_REQUEST['selectedProperty']))
			$property_uid	= intval( jomresGetParam( $_REQUEST, 'selectedProperty', 0 ) );
		else
			$property_uid		= intval( jomresGetParam( $_REQUEST, 'property_uid', 0 ) );
		
		if ($property_uid ==0) // We don't know what the property uid is, so there's nothing else we can do so we'll back out of this script right here.
			return;
		
		
		// This plugin is a neat way of showing our developers how they can briefly override the path to a template, set it to a new one, trigger a minicomponent, then reset the path to it's orginal setting again.
		
		// First we'll get the already set custom paths.
		$current_custom_paths = get_showtime('custom_paths');
		
		// If there's already a custom path to contact_owner.html set, we'll stick it in the $original_path variable
		$original_path = '';
		if (isset($current_custom_paths['contact_owner.html']))
			$original_path = $current_custom_paths['contact_owner.html'];
			
		// Now we'll set the paths to the contact_owner html file to this plugin's path.
		$current_custom_paths['contact_owner.html'] = $ePointFilepath.'templates'.JRDS.find_plugin_template_directory();
		
		// And set it again.
		set_showtime('custom_paths',$current_custom_paths);
		
		// Now, when we run the contactowner minicomp it'll use this plugin's path to the contact owner templates
		$form = $MiniComponents->specificEvent('06000','contactowner',array("noshownow"=>true,"property_uid"=>$property_uid));
		
		echo $form;
		
		// Now we'll set the path to the contact owner template back to it's original setting.
		if ($original_path != '')
			$current_custom_paths['contact_owner.html'] = $original_path;
		else
			unset ($current_custom_paths['contact_owner.html']);
		set_showtime('custom_paths',$current_custom_paths);
		
		// Neat, huh?
		}
	
	
	
	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}

?>