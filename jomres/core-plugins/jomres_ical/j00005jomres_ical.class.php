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

class j00005jomres_ical {
	function __construct($componentArgs)
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return 
		$MiniComponents =jomres_singleton_abstract::getInstance('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		
		$obsolete_plugin_files = get_showtime('obsolete_plugin_files');
		$obsolete_plugin_files[] = get_showtime('ePointFilepath').'j00011manager_option_13_ical_feed.class.php';
		$obsolete_plugin_files[] = get_showtime('ePointFilepath').'j06000ical_feed.class.php';
		$obsolete_plugin_files[] = get_showtime('ePointFilepath').'j06002ical_export.class.php';
		$obsolete_plugin_files[] = get_showtime('ePointFilepath').'class.iCalReader.php';
		set_showtime('obsolete_plugin_files',$obsolete_plugin_files);
			
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
