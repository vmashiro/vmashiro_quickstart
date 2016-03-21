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

class j00001global_strings {
	function __construct($componentArgs)
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return 
		if (!function_exists('jomres_getSingleton'))
			{
			global $ePointFilepath,$jomresConfig_lang,$MiniComponents;
			}
		else
			{
			$MiniComponents =jomres_getSingleton('mcHandler');
			$ePointFilepath = get_showtime('ePointFilepath');
			$jomresConfig_lang = get_showtime('lang');
			}

		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}

		if (file_exists($ePointFilepath.'language'.JRDS.$jomresConfig_lang.'.php'))
			require_once($ePointFilepath.'language'.JRDS.$jomresConfig_lang.'.php');
		else
			{
			if (file_exists($ePointFilepath.'language'.JRDS.'en-GB.php'))
				require_once($ePointFilepath.'language'.JRDS.'en-GB.php');
			}
		}

	/**
	#
	 * Must be included in every mini-component
	#
	 * Returns any settings the the mini-component wants to send back to the calling script. In addition to being returned to the calling script they are put into an array in the mcHandler object as eg. $mcHandler->miniComponentData[$ePoint][$eName]
	#
	 */
	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}
?>