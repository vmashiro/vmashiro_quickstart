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


class j16000do_data_wipe
	{
	function __construct()
		{
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$ePointFilepath = get_showtime('ePointFilepath');
		
		$tables_array = array();
		
		
		$tables_array[] = '#__jomcomp_cronlog';
		$tables_array[] = '#__jomcomp_mufavourites';
		$tables_array[] = '#__jomcomp_notes';
		$tables_array[] = '#__jomresportal_invoices';
		$tables_array[] = '#__jomresportal_invoices_transactions';
		$tables_array[] = '#__jomresportal_lineitems';
		$tables_array[] = '#__jomresportal_orphan_lineitems';
		$tables_array[] = '#__jomresportal_subscribers';
		$tables_array[] = '#__jomresportal_subscriptions';
		$tables_array[] = '#__jomres_audit';
		$tables_array[] = '#__jomres_audit_archive';
		$tables_array[] = '#__jomres_booking_data_archive';
		$tables_array[] = '#__jomres_contracts';
		$tables_array[] = '#__jomres_guests';
		$tables_array[] = '#__jomres_guest_profile';
		$tables_array[] = '#__jomres_pcounter';
		$tables_array[] = '#__jomres_reviews_ratings';
		$tables_array[] = '#__jomres_reviews_ratings_confirm';
		$tables_array[] = '#__jomres_reviews_ratings_detail';
		$tables_array[] = '#__jomres_reviews_reports';
		$tables_array[] = '#__jomres_room_bookings';
		$tables_array[] = '#__jomres_extraservices';
		
		$tables_array[] = '#__jomres_beds24_contract_booking_number_xref';
		$tables_array[] = '#__jomres_beds24_transaction_log';
		
		
		
		foreach ($tables_array as $table)
			{
			echo jr_gettext('_JOMRES_DATAWIPE_EMPTYING',_JOMRES_DATAWIPE_EMPTYING,false)." ".$table." ";
			$query = $query = "truncate table ".$table;
			$result = doInsertSql($query);
			if (!using_bootstrap())
				{
				if ($result)
					echo "<div class='ui-state-highlight'>".jr_gettext('_JOMRES_DATAWIPE_EMPTYING_SUCCESS',_JOMRES_DATAWIPE_EMPTYING_SUCCESS,false)."</div>";
				else
					echo "<div class='ui-state-error'>".jr_gettext('_JOMRES_DATAWIPE_EMPTYING_FAILURE',_JOMRES_DATAWIPE_EMPTYING_FAILURE,false)."</div>";
				}
			else
				{
				if ($result)
					echo "<div class='alert alert-success'>".jr_gettext('_JOMRES_DATAWIPE_EMPTYING_SUCCESS',_JOMRES_DATAWIPE_EMPTYING_SUCCESS,false)."</div>";
				else
					echo "<div class='alert alert-error'>".jr_gettext('_JOMRES_DATAWIPE_EMPTYING_FAILURE',_JOMRES_DATAWIPE_EMPTYING_FAILURE,false)."</div>";
				}
			echo "<br />";
			}
		
		//jomresRedirect(JOMRES_SITEPAGE_URL_ADMIN."&task=external_notification", '');
		}

	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}