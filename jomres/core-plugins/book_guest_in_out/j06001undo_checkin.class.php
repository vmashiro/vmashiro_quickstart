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

class j06001undo_checkin 
	{
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$defaultProperty=getDefaultProperty();
		$mrConfig=getPropertySpecificSettings();
		
		$contract_uid = jomresGetParam( $_REQUEST, 'contract_uid', 0 );
		
		if ($contract_uid == 0)
			return;	
			
		$today = date("Y/m/d");
		$query="UPDATE #__jomres_contracts SET `booked_in`= 0,`true_arrival`='' WHERE contract_uid = '".(int)$contract_uid."' AND property_uid = '".(int)$defaultProperty."'";
		if (!doInsertSql($query,'') )
			trigger_error ("Unable to update contracts table when undoing checkin, mysql db failure", E_USER_ERROR);
		else
			{
			addBookingNote($contract_uid,$defaultProperty,"Undone booked guest in");
			$jomres_messaging =jomres_getSingleton('jomres_messages');
			$jomres_messaging->set_message("Undone booked guest in");
			jomresRedirect( jomresURL(JOMRES_SITEPAGE_URL."&task=editBooking&contract_uid=$contract_uid"),  "Undone booked guest in" );
			}
		}

	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}
