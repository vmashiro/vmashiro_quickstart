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

class j00005advanced_micromanage_tariff_editing_modes
	{
	function __construct()
		{
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$obsolete_plugin_files = get_showtime('obsolete_plugin_files');
		$obsolete_plugin_files[] = get_showtime('ePointFilepath').'j04006rooms_config_advanced.class.php';
		$obsolete_plugin_files[] = get_showtime('ePointFilepath').'j02210listtariffs_advanced.class.php';
		$obsolete_plugin_files[] = get_showtime('ePointFilepath').'j02212edittariff_advanced.class.php';
		$obsolete_plugin_files[] = get_showtime('ePointFilepath').'j02214savetariff_advanced.class.php';
		$obsolete_plugin_files[] = get_showtime('ePointFilepath').'j02216deletetariff.class.php';
		$obsolete_plugin_files[] = get_showtime('ePointFilepath').'j02211listtariffs_micromanage.class.php';
		$obsolete_plugin_files[] = get_showtime('ePointFilepath').'j02213edittariff_micromanage.class.php';
		$obsolete_plugin_files[] = get_showtime('ePointFilepath').'j02215savetariff_micromanage.class.php';
		$obsolete_plugin_files[] = get_showtime('ePointFilepath').'j02217deletetariff.class.php';
		set_showtime('obsolete_plugin_files',$obsolete_plugin_files);
		
		$property_uid=getDefaultProperty();
		$mrConfig=getPropertySpecificSettings($property_uid);
		
		if ($mrConfig['tariffmode']!='0')
			unset($MiniComponents->registeredClasses['00011manager_option_02_propertyadmin']);
		
		if (file_exists(get_showtime('ePointFilepath').'language'.JRDS.get_showtime('lang').'.php'))
			require_once(get_showtime('ePointFilepath').'language'.JRDS.get_showtime('lang').'.php');
		else
			{
			if (file_exists(get_showtime('ePointFilepath').'language'.JRDS.'en-GB.php'))
				require_once(get_showtime('ePointFilepath').'language'.JRDS.'en-GB.php');
			}
			
		

		}

	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}

?>