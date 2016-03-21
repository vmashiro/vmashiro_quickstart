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

/**
#
 * Delete an optional extra
 #
* @package Jomres
#
 */
class j16000sms_clickatell_settings {
	/**
	#
	 * Constructor:  Delete an optional extra
	#
	 */
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return 
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$output=array();
		$pageoutput=array();

		jr_import('jrportal_sms_clickatell_settings');
		$sms_clickatell_settings = new jrportal_sms_clickatell_settings();
		$sms_clickatell_settings->get_sms_clickatell_settings();
		
		$yesno = array();
		$yesno[] = jomresHTML::makeOption( '0', jr_gettext("_JOMRES_COM_MR_NO",_JOMRES_COM_MR_NO,false) );
		$yesno[] = jomresHTML::makeOption( '1', jr_gettext("_JOMRES_COM_MR_YES",_JOMRES_COM_MR_YES,false) );
	
		$output['PAGETITLE'] 		=jr_gettext("_JRPORTAL_SMS_CLICKATELL_TITLE",_JRPORTAL_SMS_CLICKATELL_TITLE,false);
		$output['HUSERNAME']		=jr_gettext("_JRPORTAL_SMS_CLICKATELL_USERNAME",_JRPORTAL_SMS_CLICKATELL_USERNAME,false);
		$output['HPASSWORD']		=jr_gettext("_JRPORTAL_SMS_CLICKATELL_PASSWORD",_JRPORTAL_SMS_CLICKATELL_PASSWORD,false);
		$output['HAPI_ID']			=jr_gettext("_JRPORTAL_SMS_CLICKATELL_APIID",_JRPORTAL_SMS_CLICKATELL_APIID,false);
		$output['INSTRUCTIONS']		=jr_gettext("_JRPORTAL_SMS_CLICKATELL_INSTRUCTIONS",_JRPORTAL_SMS_CLICKATELL_INSTRUCTIONS,false);
		$output['HACTIVE']			=jr_gettext("_JOMCOMP_WISEPRICE_ACTIVE",_JOMCOMP_WISEPRICE_ACTIVE,false);
		
		
		$output['ACTIVE']	= jomresHTML::selectList( $yesno, 'active','class="inputbox" size="1"', 'value', 'text', $sms_clickatell_settings->sms_clickatellConfigOptions['active']);
		
		$output['USERNAME']	= $sms_clickatell_settings->sms_clickatellConfigOptions['username'];
		$output['PASSWORD']	= $sms_clickatell_settings->sms_clickatellConfigOptions['password'];
		$output['API_ID'] 	= $sms_clickatell_settings->sms_clickatellConfigOptions['api_id'];

		$jrtbar =jomres_getSingleton('jomres_toolbar');
		$jrtb  = $jrtbar->startTable();
		
		$jrtb .= $jrtbar->toolbarItem('cancel',jomresURL(JOMRES_SITEPAGE_URL_ADMIN),'');
		$jrtb .= $jrtbar->toolbarItem('save','','',true,'save_sms_clickatell_settings');
		$jrtb .= $jrtbar->endTable();
		$output['JOMRESTOOLBAR']=$jrtb;

		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		$tmpl->setRoot( JOMRES_TEMPLATEPATH_ADMINISTRATOR );
		$tmpl->readTemplatesFromInput( 'sms_clickatell_settings.html');
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