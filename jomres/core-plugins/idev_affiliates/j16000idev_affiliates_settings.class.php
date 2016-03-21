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

class j16000idev_affiliates_settings {
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return 
		if (!function_exists('jomres_getSingleton'))
			global $MiniComponents;
		else
			$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		global $ePointFilepath;
		$output=array();
		$pageoutput=array();

		$ida_settings = new jrportal_idev_affiliates_settings();
		$ida_settings->get_idev_affiliates_settings();

		$output['PAGETITLE'] 		=jr_gettext('_JRPORTAL_IDEV_AFFILIATES_TITLE',_JRPORTAL_IDEV_AFFILIATES_TITLE,false);
		$output['HPATH']			=jr_gettext('_JRPORTAL_IDEV_AFFILIATES',_JRPORTAL_IDEV_AFFILIATES,false);
		$output['PATH_DESC']		=jr_gettext('_JRPORTAL_IDEV_AFFILIATES_DESC',_JRPORTAL_IDEV_AFFILIATES_DESC,false);
		$output['HPROFILE']			=jr_gettext('_JRPORTAL_IDEV_AFFILIATES_PROFILE',_JRPORTAL_IDEV_AFFILIATES_PROFILE,false);
		$output['PROFILE_DESC']		=jr_gettext('_JRPORTAL_IDEV_AFFILIATES_PROFILE_DESC',_JRPORTAL_IDEV_AFFILIATES_PROFILE_DESC,false);
		
		$output['PATH'] = $ida_settings->idaConfigOptions['idev_affiliates_pathtosalephp'];
		$output['PROFILE'] = $ida_settings->idaConfigOptions['profile'];

		if (class_exists('jomres_toolbar'))
     		$jrtbar = new jomres_toolbar();
    	else
     		$jrtbar =jomres_getSingleton('jomres_toolbar');
		$jrtb  = $jrtbar->startTable();
		
		$jrtb .= $jrtbar->toolbarItem('cancel',JOMRES_SITEPAGE_URL_ADMIN,'');
		$jrtb .= $jrtbar->toolbarItem('save','','',true,'save_idev_affiliates_settings');
		$jrtb .= $jrtbar->endTable();
		$output['JOMRESTOOLBAR']=$jrtb;
		
		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		$tmpl->setRoot( $ePointFilepath.'templates'.JRDS.find_plugin_template_directory() );
		$tmpl->readTemplatesFromInput( 'idev_affiliates_settings.html');
		$tmpl->addRows( 'pageoutput',$pageoutput);
		$tmpl->displayParsedTemplate();
		}

	/**
	#
	 * Must be included in every mini-component
	#
	 * Returns any settings the the mini-component wants to send back to the calling script. In addition to being returned to the calling script they are put into an array in the mcHandler object as eg. $mcHandler->miniComponentData[$ePoint][$eName]
	#
	 */
	function getRetVals()
		{
		return null;
		}
	}
?>