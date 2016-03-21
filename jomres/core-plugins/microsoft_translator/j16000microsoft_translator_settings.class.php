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

class j16000microsoft_translator_settings
	{
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return 
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$ePointFilepath = get_showtime('ePointFilepath');
		$ePointLivesite = get_showtime('eLiveSite');
		
		$output['PAGETITLE'] 						=jr_gettext("_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS",_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS,false);
		$output['_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS_APIKEY']	=jr_gettext("_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS_APIKEY",_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS_APIKEY,false);
		$output['_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS_INFO']	=jr_gettext("_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS_INFO",_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS_INFO,false);
		$output['_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS_CLIENTID']	=jr_gettext("_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS_CLIENTID",_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS_CLIENTID,false);
		$output['PATHTOTHISDIR']=$ePointLivesite;
		jr_import("microsoft_translator_settings");
		$microsoft_translator_settings = new microsoft_translator_settings();
		$microsoft_translator_settings->get_settings();
		
		$output['ACCOUNT_KEY']=$microsoft_translator_settings->settings['account_key'];
		$output['CLIENT_ID']=$microsoft_translator_settings->settings['client_id'];
		
		$jrtbar =jomres_getSingleton('jomres_toolbar');
		$jrtb  = $jrtbar->startTable();
		
		$jrtb .= $jrtbar->toolbarItem('cancel',jomresURL(JOMRES_SITEPAGE_URL_ADMIN),'');
		$jrtb .= $jrtbar->toolbarItem('save','','',true,'save_microsoft_translator_settings');
		$jrtb .= $jrtbar->endTable();
		$output['JOMRESTOOLBAR']=$jrtb;
		
		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		$tmpl->setRoot( $ePointFilepath.'templates'.JRDS.find_plugin_template_directory() );
		$tmpl->readTemplatesFromInput( 'settings.html');
		$tmpl->addRows( 'pageoutput',$pageoutput);
		$tmpl->displayParsedTemplate();
		}
	
	
	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}
	




?>