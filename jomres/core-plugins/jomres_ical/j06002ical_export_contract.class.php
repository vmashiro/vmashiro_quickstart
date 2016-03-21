<?php
/**
 * Core file
 *
 * @author Vince Wooll <sales@jomres.net>
 * @version Jomres 8
 * @package Jomres
 * @copyright	2005-2015 Vince Wooll
 * Jomres (tm) PHP, CSS & Javascript files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project, and use it accordingly.
 **/

// ################################################################
defined( '_JOMRES_INITCHECK' ) or die( '' );
// ################################################################

//This is a month view chart the occupancy - number of rooms booked by day in the selected month
class j06002ical_export_contract
	{
	function __construct($componentArgs)
		{
		$MiniComponents = jomres_singleton_abstract::getInstance( 'mcHandler' );
		if ( $MiniComponents->template_touch )
			{
			$this->template_touchable = false;
			return;
			}
		
		if (isset($componentArgs[ 'output_now' ]))
			$output_now = $componentArgs[ 'output_now' ];
		else
			$output_now = true;

		$property_uid = jomresGetParam($_REQUEST, 'property_uid', 0);
		$contract_uid = jomresGetParam($_REQUEST, 'contract_uid', 0);
		
		if ($contract_uid == 0 || $property_uid == 0)
			return;
		
		$thisJRUser = jomres_singleton_abstract::getInstance( 'jr_user' );
		
		if (!in_array($property_uid, $thisJRUser->authorisedProperties))
			return;
		
		$current_property_details = jomres_singleton_abstract::getInstance( 'basic_property_details' );
		$current_property_details->gather_data($property_uid);
		
		$mrConfig = getPropertySpecificSettings($property_uid);

		if ( $mrConfig[ 'is_real_estate_listing' ] == 1 || get_showtime('is_jintour_property')) 
			return;
		
		$clause = " AND a.contract_uid = ".$contract_uid;
		
		$query = "SELECT 
						a.contract_uid, 
						a.arrival, 
						a.departure, 
						a.contract_total, 
						a.tag,
						a.currency_code,
						a.booked_in, 
						a.bookedout, 
						a.deposit_required, 
						a.deposit_paid, 
						a.special_reqs, 
						a.timestamp, 
						a.cancelled, 
						a.invoice_uid,
						a.property_uid,
						a.approved,
						a.last_changed,
						b.firstname, 
						b.surname, 
						b.tel_landline, 
						b.tel_mobile, 
						b.email 
					FROM #__jomres_contracts a 
						LEFT JOIN #__jomres_guests b ON a.guest_uid = b.guests_uid 
					WHERE a.property_uid = ".(int)$property_uid."  
						AND a.cancelled = 0 "
						. $clause .
						" GROUP BY a.contract_uid ";
		$jomresContractsList = doSelectSql( $query );
		
		$event_params = array();
		
		foreach ($jomresContractsList as $c)
			{
			$summary = $c->firstname.' '.$c->surname;
			$description = $c->tag;
			$url = jomresURL(JOMRES_SITEPAGE_URL_NOSEF.'&task=editBooking' . '&contract_uid=' . $c->contract_uid . '&thisProperty=' . $c->property_uid);
		
			$event_params[] = array(
								   'uid' => $c->contract_uid,
								   'summary' => $summary,
								   'description' => $description,
								   'start' => new DateTime($c->arrival),
								   'end' => new DateTime($c->departure),
								   'created' => new DateTime($c->timestamp),
								   'modified' => new DateTime($c->last_changed),
								   'location' => $current_property_details->property_name, 
								   'url' => $url
								   );
			}
		
		jr_import( 'jomres_ical' );
		$ical = new jomres_ical();
		$ical->events = $event_params;
		$ical->title  = 'Jomres Calendar';
		$ical->author = 'Jomres.net';
		$ical->generateDownload();
		}

	function getRetVals()
		{
		return $this->retVals;
		}
	}
