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

class j06002deleteCoupon {
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

		
		$coupon_id=jomresGetParam( $_REQUEST, 'coupon_id', 0 );
		$defaultProperty=getDefaultProperty();
		if ($coupon_id>0)
			{
			$query="DELETE FROM #__jomres_coupons WHERE coupon_id = '".(int)$coupon_id."' AND property_uid = '".(int)$defaultProperty."'";
			if (!doInsertSql($query,jr_gettext('_JRPORTAL_COUPONS_SQLERROR',_JRPORTAL_COUPONS_SQLERROR,FALSE)))
				trigger_error ("Unable to delete from coupons table, mysql db failure", E_USER_ERROR);
			$jomres_messaging =jomres_getSingleton('jomres_messages');
			$jomres_messaging->set_message(jr_gettext('_JOMRES_MR_AUDIT_DELETE_COUPON',_JOMRES_MR_AUDIT_DELETE_COUPON,FALSE));
			
			jomresRedirect( jomresURL(JOMRES_SITEPAGE_URL."&task=listCoupons"), $saveMessage );
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