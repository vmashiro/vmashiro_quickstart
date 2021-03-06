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

class j06002saveCoupon {
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$thisJRUser=jomres_getSingleton('jr_user');
		if (!$thisJRUser->userIsManager)
			return;
		

		$coupon_code			= jomresGetParam( $_POST, 'coupon_code', '' );
		$coupon_id				= (int)jomresGetParam( $_POST, 'coupon_id', 0 );
		$guest_uid				= (int)jomresGetParam( $_POST, 'guest_uid', 0 );

		$valid_from=JSCalConvertInputDates($_POST['valid_from']);
		$valid_to=JSCalConvertInputDates($_POST['valid_to']);
		
		$amount					= jomresGetParam( $_POST, 'amount', 0.00 );
		$is_percentage			= (bool)jomresGetParam( $_POST, 'is_percentage', '' );
		
		$booking_valid_from=JSCalConvertInputDates($_POST['booking_valid_from']);
		$booking_valid_to=JSCalConvertInputDates($_POST['booking_valid_to']);

		$explodedvalid_from = explode ("/",$valid_from);
		$valid_from = $explodedvalid_from[0]."-".$explodedvalid_from[1]."-".$explodedvalid_from[2];
		$explodedvalid_to = explode ("/",$valid_to);
		$valid_to = $explodedvalid_to[0]."-".$explodedvalid_to[1]."-".$explodedvalid_to[2];
		
		$defaultProperty=getDefaultProperty();

		$auditMessage=jr_gettext('_JOMRES_MR_AUDIT_UPDATE_COUPON',_JOMRES_MR_AUDIT_UPDATE_COUPON,FALSE);
		if ($coupon_id > 0)
			{
			$query="UPDATE #__jomres_coupons SET `coupon_code`='$coupon_code',`valid_from`='$valid_from',
			`valid_to`='$valid_to',`amount`='$amount',`is_percentage`='$is_percentage',`booking_valid_from`='$booking_valid_from',`booking_valid_to`='$booking_valid_to',`guest_uid`=$guest_uid
			WHERE coupon_id = $coupon_id AND property_uid = $defaultProperty";
			if (!doInsertSql($query)) trigger_error ("Unable to update coupon details, mysql db failure", E_USER_ERROR);
			}
		else
			{
			$query="INSERT INTO #__jomres_coupons (`property_uid`,`coupon_code`,`valid_from`,`valid_to`,`amount`,`is_percentage`,`booking_valid_from`,`booking_valid_to`,`guest_uid`)
			VALUES 
			($defaultProperty,'$coupon_code','$valid_from','$valid_to','$amount','$is_percentage','$booking_valid_from','$booking_valid_to',$guest_uid)";
			if (!doInsertSql($query)) trigger_error ("Unable to insert coupon details, mysql db failure", E_USER_ERROR);
			}

		$jomres_messaging =jomres_getSingleton('jomres_messages');
		$jomres_messaging->set_message($auditMessage);
			
		jomresRedirect( jomresURL(JOMRES_SITEPAGE_URL."&task=listCoupons"), '' );
		}


	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}
?>