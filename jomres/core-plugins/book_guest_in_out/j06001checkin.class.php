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
 * Constructs and displays booking in data
 #
* @package Jomres
#
 */
class j06001checkin {
	/**
	#
	 * Constructor: Constructs and displays booking in data
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
		$defaultProperty=getDefaultProperty();
		$mrConfig=getPropertySpecificSettings();
		
		$contract_uid = jomresGetParam( $_REQUEST, 'contract_uid', 0 );
		
		if ($contract_uid == 0)
			return;	
			
		$today = date("Y/m/d");
		$query="UPDATE #__jomres_contracts SET `booked_in`='1',`true_arrival`='$today' WHERE contract_uid = '".(int)$contract_uid."' AND property_uid = '".(int)$defaultProperty."'";
		if (!doInsertSql($query,jr_gettext('_JOMRES_MR_AUDIT_BOOKEDGUESTIN',_JOMRES_MR_AUDIT_BOOKEDGUESTIN,FALSE)) )
			trigger_error ("Unable to update contracts table when booking guest in, mysql db failure", E_USER_ERROR);
		else
			{
			addBookingNote($contract_uid,$defaultProperty,jr_gettext('_JOMRES_MR_AUDIT_BOOKEDGUESTIN',_JOMRES_MR_AUDIT_BOOKEDGUESTIN,FALSE));
			$jomres_messaging =jomres_getSingleton('jomres_messages');
			$jomres_messaging->set_message(jr_gettext('_JOMRES_MR_AUDIT_BOOKEDGUESTIN',_JOMRES_MR_AUDIT_BOOKEDGUESTIN,FALSE));
			jomresRedirect( jomresURL(JOMRES_SITEPAGE_URL."&task=editBooking&contract_uid=$contract_uid"),  jr_gettext('_JOMRES_FRONT_MR_BOOKIN_GUESTBOOKEDIN',_JOMRES_FRONT_MR_BOOKIN_GUESTBOOKEDIN,false ) );
			}
		}

	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}
