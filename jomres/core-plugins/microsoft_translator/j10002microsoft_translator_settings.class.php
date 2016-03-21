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

class j10002microsoft_translator_settings
	{
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return 
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		
		if (function_exists('jomres_getSingleton') )
			$htmlFuncs =jomres_getSingleton('html_functions');
		else
			global $htmlFuncs;
		$siteConfig = jomres_singleton_abstract::getInstance( 'jomres_config_site_singleton' );
		$jrConfig   = $siteConfig->get();
		if ( $jrConfig[ 'advanced_site_config' ] == 1 )
			{
			$this->cpanelButton=$htmlFuncs->cpanelButton(JOMRES_SITEPAGE_URL_ADMIN.'&task=microsoft_translator_settings', 'microsoft.png', jr_gettext("_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS",_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS,false),"/".JOMRES_ROOT_DIRECTORY."/images/jomresimages/small/",jr_gettext( "_JOMRES_CUSTOMCODE_MENUCATEGORIES_LANGUAGES" , _JOMRES_CUSTOMCODE_MENUCATEGORIES_LANGUAGES ,false,false));
			}
		}
	
	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return $this->cpanelButton;
		}	
	}
?>