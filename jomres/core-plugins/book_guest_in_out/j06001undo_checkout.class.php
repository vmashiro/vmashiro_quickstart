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

 class j06001undo_checkout 
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

		$contract_uid = jomresGetParam( $_REQUEST, 'contract_uid', 0 );

		$saveMessage= "Undone booked guest out";
		$jomres_messaging =jomres_getSingleton('jomres_messages');
		$jomres_messaging->set_message($saveMessage);
		
		$query="SELECT guest_uid FROM #__jomres_contracts WHERE contract_uid = '".(int)$contract_uid."' AND property_uid = '".(int)$defaultProperty."'";
		$contractData =doSelectSql($query);

		if (count($contractData)>0)
			{
			$query="UPDATE #__jomres_contracts SET `bookedout`= 0, `bookedout_timestamp`='0000-00-00 00:00:00' WHERE contract_uid = '".(int)$contract_uid."' AND property_uid = '".(int)$defaultProperty."'";
			if (!doInsertSql($query,""))
				trigger_error ("Unable to update undo booking guest out data for contract". (int)$contract_uid.", mysql db failure", E_USER_ERROR);

			$query="INSERT INTO #__jomcomp_notes (`contract_uid`,`note`,`timestamp`,`property_uid`) VALUES ('".(int)$contract_uid."','".$saveMessage."','".date( 'Y-m-d H:i:s' )."','".(int)$defaultProperty."')";
			doInsertSql($query,"");
			}
		else
			trigger_error ("Error, cannot reconcile contract uid ".(int)$contract_uid." with property uid ".(int)$defaultProperty, E_USER_ERROR);
		
		jomresRedirect(jomresURL(JOMRES_SITEPAGE_URL."&task=list_bookings"), $saveMessage );
		}

	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}
