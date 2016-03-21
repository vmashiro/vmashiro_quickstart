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
class j06002ical_import_file
	{
	function __construct($componentArgs)
		{
		$MiniComponents = jomres_singleton_abstract::getInstance( 'mcHandler' );
		if ( $MiniComponents->template_touch )
			{
			$this->template_touchable = false;
			return;
			}
		$ePointFilepath=get_showtime('ePointFilepath');
		$this->property_uid=getDefaultProperty();
		
		$mrConfig = getPropertySpecificSettings( $this->property_uid );
		
		if ( $mrConfig[ 'is_real_estate_listing' ] == 1 || get_showtime('is_jintour_property')) 
			return;
		
		$this->room_type = jomresGetParam($_POST, 'room_type', 0); 
		
		if ($this->room_type == 0)
			jomresRedirect( jomresURL(JOMRES_SITEPAGE_URL."&task=ical_import"),"No room type selected");

		if ($_FILES['ical_file']['error'] == 4 || !isset($_FILES['ical_file']) )
			jomresRedirect( jomresURL(JOMRES_SITEPAGE_URL."&task=ical_import"),jr_gettext('_JOMRES_ICAL_NO_FILE_UPLOADED',_JOMRES_ICAL_NO_FILE_UPLOADED,false));
		else
			{
			jr_import('icalreader');
			$ical   = new ICal($_FILES['ical_file']['tmp_name']);
			$events = $ical->events();

			$basic_property_details	= jomres_singleton_abstract::getInstance( 'basic_property_details' );
			$basic_property_details->gather_data($this->property_uid);

			$this->default_availability = array();

			foreach ( $basic_property_details->rooms_by_type[$this->room_type] as $k=>$v)
				{
				$this->default_availability[ $v ] = 1;
				}

			// $query="SELECT tag FROM #__jomres_contracts WHERE `property_uid` = '".$this->property_uid."'";
			// $tagList = doSelectSql($query);
			// $existing_booking_numbers = array();
			// if (count($tagList)>0)
				// {
				// foreach ($tagList as $tag)
					// {
					// $existing_booking_numbers[]=$tag->tag;
					// }
				// }
			
			if ( count($events) == 0)
				{
				echo jr_gettext('_JOMRES_ICAL_ERROR_NO_EVENTS',_JOMRES_ICAL_ERROR_NO_EVENTS,false,false);
				return false;
				}
			
			$rows=array();
			foreach ($events as $event)
				{
				$r=array();

				$this->failure_messages = array();
				//$booking_number = (int) $event['DESCRIPTION']; // Currently all Jomres booking numbers are forced to be integers.
				//if (in_array($booking_number,$existing_booking_numbers))
					//$this->failure_messages[]=jr_gettext('_JOMRES_ICAL_ERROR_BOOKING_NUMBER_EXISTS',_JOMRES_ICAL_ERROR_BOOKING_NUMBER_EXISTS,false,false);

				$arrivalDate = date("Y/m/d",$ical->iCalDateToUnixTimestamp($event['DTSTART']));
				$departureDate = date("Y/m/d",$ical->iCalDateToUnixTimestamp($event['DTEND']));

				$availability = $this->find_available_rooms_for_date_range($arrivalDate,$departureDate);
				
				if ( count($availability)==0)
					$this->failure_messages[]= jr_gettext('_JOMRES_ICAL_ERROR_NO_ROOMS',_JOMRES_ICAL_ERROR_NO_ROOMS,false,false);
				elseif ( count($this->failure_messages) ==0)
					{
					reset($availability);
					$room_uid = key($availability);

					$new_booking = new stdClass;

					$new_booking->firstNight		= date("Y-m-d",$ical->iCalDateToUnixTimestamp($event['DTSTART']));
					$new_booking->lastNight			= date("Y-m-d",$ical->iCalDateToUnixTimestamp($event['DTEND']));
					$new_booking->roomId			= $room_uid;
					$new_booking->guestName			= $event['SUMMARY']; //we assume this includes the guest name, but usualy it doesn`t, instead it`s a general event name that may include the guest name too.
					$new_booking->price				= "1" ;
					$new_booking->tax				= "0";
					$new_booking->refererEditable	= "iCal file import";
					$new_booking->description		= $event['DESCRIPTION'];
					$new_booking->location			= $event['LOCATION'];
					$new_booking->url				= $event['URL'];
					//$this->insert_booking($new_booking , $event['DESCRIPTION'] );
					$this->insert_black_booking($new_booking);
					}

				$r['SUMMARY']		= $event['SUMMARY'];
				$r['DTSTART']		= outputDate($arrivalDate);
				$r['DTEND']			= outputDate($departureDate);
				$r['DESCRIPTION']	= $event['DESCRIPTION'];
		
				if ( count($this->failure_messages) == 0)
					{
					$r['RESULT'] =simple_template_output($ePointFilepath.'templates'.JRDS.find_plugin_template_directory() , 'ical_import_success.html' , jr_gettext('_JOMRES_ICAL_SUCCESS',_JOMRES_ICAL_SUCCESS,false,false) );
					}
				else
					{
					$r['RESULT'] =simple_template_output($ePointFilepath.'templates'.JRDS.find_plugin_template_directory() , 'ical_import_failure.html' ,$this->failure_messages[0] );
					}
				$rows[]=$r;
				}
			}

 		$pageoutput=array();
		$output=array();

		$output['PAGETITLE']=jr_gettext('_JOMRES_ICAL_IMPORT',_JOMRES_ICAL_IMPORT,false,false);

		$output['_JOMRES_ICAL_RESULT_HEADER_SUMMARY']		=jr_gettext('_JOMRES_ICAL_RESULT_HEADER_SUMMARY',_JOMRES_ICAL_RESULT_HEADER_SUMMARY,false,false);
		$output['_JOMRES_ICAL_RESULT_HEADER_DESCRIPTION']	=jr_gettext('_JOMRES_ICAL_RESULT_HEADER_DESCRIPTION',_JOMRES_ICAL_RESULT_HEADER_DESCRIPTION,false,false);
		$output['_JOMRES_ICAL_RESULT_HEADER_START']			=jr_gettext('_JOMRES_ICAL_RESULT_HEADER_START',_JOMRES_ICAL_RESULT_HEADER_START,false,false);
		$output['_JOMRES_ICAL_RESULT_HEADER_END']			=jr_gettext('_JOMRES_ICAL_RESULT_HEADER_END',_JOMRES_ICAL_RESULT_HEADER_END,false,false);
		$output['_JOMRES_ICAL_RESULT_HEADER_RESULT']		=jr_gettext('_JOMRES_ICAL_RESULT_HEADER_RESULT',_JOMRES_ICAL_RESULT_HEADER_RESULT,false,false);

		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		$tmpl->setRoot( $ePointFilepath.'templates'.JRDS.find_plugin_template_directory() );
		$tmpl->readTemplatesFromInput( "ical_import_result.html" );
		$tmpl->addRows( 'pageoutput',$pageoutput);
		$tmpl->addRows( 'rows',$rows);
		$tmpl->displayParsedTemplate();

		}
	
	function insert_black_booking($new_booking )
		{
		$this->failure_messages = array();
		if (
			trim($new_booking->firstNight) == "" ||
			trim($new_booking->lastNight) == "" ||
			trim($new_booking->roomId) == "" ||
			trim($new_booking->guestName) == "" 
			)
			{
			if ( trim($new_booking->firstNight) == "" )		$this->failure_messages[] = "firstNight was incomplete ";
			if ( trim($new_booking->lastNight) == "" )		$this->failure_messages[] = "lastNight was incomplete ";
			if ( trim($new_booking->roomId) == "" )			$this->failure_messages[] = "roomId was incomplete ";
			if ( trim($new_booking->guestName) == "" )		$new_booking->guestName = "Unknown";
			}
		
		$mrConfig = getPropertySpecificSettings($this->property_uid);
		
		$numberOfAdults=0;
		$numberOfChildren=0;
		$arrivalDate=$start;
		$departureDate=$end;
		$guests_uid=0;
		$rates_uid=0;
		$cotRequired=0;
		$rate_rules="0";
		$single_person_suppliment=0;
		$deposit_required=0;
		$contract_total=0;
		$cot_suppliment=0;
		$extras="";
		$extrasValue=0;
		
		$specialReqs = 	'GUEST/EVENT NAME: '.$new_booking->guestName.'\r\n'.
						'DESCRIPTION: '.$new_booking->description.'\r\n'.
						'LOCATION: '.$new_booking->location.'\r\n'.
						'URL: '.$new_booking->url.'\r\n';
		
		$arrivalDate				= str_replace("-","/",filter_var( $new_booking->firstNight, FILTER_SANITIZE_SPECIAL_CHARS ) );
		$departureDate				= date("Y/m/d" ,strtotime( filter_var( $new_booking->lastNight, FILTER_SANITIZE_SPECIAL_CHARS ) ) );
		
		$dateRangeArray 			= findDateRangeForDates( $arrivalDate , $departureDate );
		$dateRangeString			= implode(",", $dateRangeArray );
		
		if ((int)$mrConfig[ 'wholeday_booking' ] == 0)
			{
			$dateRangeArray			= array_slice($dateRangeArray, 0, count($dateRangeArray)-1, true);
			$dateRangeString		= implode(",", $dateRangeArray );
			}
		
		//we`ll make the rooms an array so we can better use this later for MRPs
		$room_uids = array('0'=>$new_booking->roomId);
		
		$query = "INSERT INTO #__jomres_contracts (
												`arrival`,
												`departure`,
												`rates_uid`,
												`guest_uid`,
												`contract_total`,
												`special_reqs`,
												`adults`,
												`children`,
												`deposit_paid`,
												`deposit_required`,
												`date_range_string`,
												`booked_in`,
												`booked_out`,
												`rate_rules`,
												`property_uid`,
												`single_person_suppliment`,
												`extras`,
												`extrasvalue`
												)
												VALUES 
												(
												'".$arrivalDate."',
												'".$departureDate."',
												".(int)$rates_uid.",
												".(int)$guests_uid.",
												".(float)$contract_total.",
												'$specialReqs',
												".(int)$numberOfAdults.",
												".(int)$numberOfChildren.",
												0,
												".(float)$deposit_required.",
												'$dateRangeString',
												0,
												0,
												'$rate_rules',
												".(int)$this->property_uid.",
												".(float)$single_person_suppliment.",
												'$extras',
												".(float)$extrasValue."
												)";
		$lastID=doInsertSql($query,'');
		if ( !$lastID )
			trigger_error ("Unable to insert into contracts table, mysql db failure", E_USER_ERROR);
		else
			{
			$contract_uid = $lastID;

			if ((int)$contract_uid > 0)
				{
				foreach ($room_uids as $room_uid)
					{
					$query="INSERT INTO #__jomres_room_bookings
						(`room_uid`,
						`date`,
						`contract_uid`,
						`black_booking`,
						`internet_booking`,
						`reception_booking`,
						`property_uid`)
						VALUES ";
					for ($i=0, $n=count($dateRangeArray); $i < $n; $i++)
						{
						$internetBooking=0;
						$receptionBooking=0;
						$blackBooking=1;
						$roomBookedDate=$dateRangeArray[$i];

						$query.= ($i>0) ? ', ':'';
						$query.="('".(int)$room_uid."','$roomBookedDate','".(int)$contract_uid."','".(int)$blackBooking."','".(int)$internetBooking."','".(int)$receptionBooking."','".(int)$this->property_uid."')";
						}
					if (!doInsertSql($query,''))
						trigger_error ("Unable to insert into room bookings table, mysql db failure", E_USER_ERROR);
					}
				}
			else
				trigger_error ("Error after inserting to contracts table, no contract uid returned.", E_USER_ERROR);
			}
		}

	//not currently used, but useful for later. Ical files don`t have enough data that can be used to create real bookings in the system
	function insert_booking($new_booking , $booking_number = '' )
		{
		$this->failure_messages = array();
		if (
			trim($new_booking->firstNight) == "" ||
			trim($new_booking->lastNight) == "" ||
			trim($new_booking->roomId) == "" ||
			trim($new_booking->guestName) == "" ||
			trim($new_booking->price) == "" ||
			trim($new_booking->tax) == ""
			)
			{
			if ( trim($new_booking->firstNight) == "" )		$this->failure_messages[] = "firstNight was incomplete ";
			if ( trim($new_booking->lastNight) == "" )		$this->failure_messages[] = "lastNight was incomplete ";
			if ( trim($new_booking->roomId) == "" )			$this->failure_messages[] = "roomId was incomplete ";
			if ( trim($new_booking->guestName) == "" )		$new_booking->guestName = "Unknown";
			if ( trim($new_booking->price) == "" )			$this->failure_messages[] = "price was incomplete ";
			if ( trim($new_booking->tax) == "" )			$this->failure_messages[] = "tax was incomplete ";
			}

		jr_import( 'jomres_generic_booking_insert' );
		$bkg = new jomres_generic_booking_insert();

		$current_property_details = jomres_singleton_abstract::getInstance( 'basic_property_details' );
		$current_property_details->gather_data($this->property_uid);

		$mrConfig = getPropertySpecificSettings( $this->property_uid );

		$propertyConfig = jomres_singleton_abstract::getInstance( 'jomres_config_property_singleton' );
		$propertyConfig->property_config['requireApproval'] ="0"; // We need to directly access the singleton to set requireApproval to 0 so that the booking doesn't require approval later. We can't use the approval functionality here as that requires tempbookingdata to allow the customer to complete the payment, which of course doesn't exist as they've not come through the Jomres booking form.

		$siteConfig        = jomres_singleton_abstract::getInstance( 'jomres_config_site_singleton' );
		$jrConfig          = $siteConfig->get();

		if ($jrConfig['useGlobalCurrency'] == "1")
			$currency_code = $jrConfig['globalCurrencyCode'];
		else
			$currency_code = $mrConfig['property_currencycode'];

		//OK, let`s move on and set the new booking details
		$bkg->booking_details = array();
		$bkg->booking_details['property_uid']				= $this->property_uid;
		$bkg->booking_details['arrivalDate']				= str_replace("-","/",filter_var( $new_booking->firstNight, FILTER_SANITIZE_SPECIAL_CHARS ) );
		$bkg->booking_details['departureDate']				= date("Y/m/d" ,strtotime( filter_var( $new_booking->lastNight, FILTER_SANITIZE_SPECIAL_CHARS ) ) );
		$dates 												= findDateRangeForDates( $bkg->booking_details['arrivalDate'] , $bkg->booking_details['departureDate'] );
		$allBarLast											= array_slice($dates, 0, count($dates)-1, true);
		$bkg->booking_details['dateRangeString']			= implode(",", $allBarLast );
		$bkg->booking_details['currency_code']				= $currency_code;

		$bkg->booking_details['referrer']					= filter_var( $new_booking->refererEditable, FILTER_SANITIZE_SPECIAL_CHARS );

		$bkg->booking_details['tax']						= (float)$new_booking->tax;
		$bkg->booking_details['contract_total']				= (float)$new_booking->price;
		$bkg->booking_details['room_total_nodiscount']		= (float)$new_booking->price;

		$bkg->booking_details['sendGuestEmail'] 			= false;
		$bkg->booking_details['sendHotelEmail'] 			= false;
		$new_booking->guestEmail = "noreply@example.com";

		if ((float)$new_booking->deposit != 0)
			$bkg->booking_details['deposit_required']			= (float)$new_booking->deposit;
		else
			$bkg->booking_details['deposit_required']			= $bkg->booking_details['contract_total'];

		$jrportal_taxrate = jomres_singleton_abstract::getInstance( 'jrportal_taxrate' );
		$cfgcode = $mrConfig[ 'accommodation_tax_code' ];
		$accommodation_tax_rate = (float) $jrportal_taxrate->taxrates[ $cfgcode ][ 'rate' ];

		if ( $mrConfig[ 'prices_inclusive' ] == 1 )
			{
			$divisor = ( $accommodation_tax_rate / 100 ) + 1;
			$price   = $bkg->booking_details['room_total_nodiscount'] / $divisor;
			$bkg->booking_details['room_total_nodiscount'] = $price;
			}

		$bkg->booking_details['depositpaidsuccessfully'	]	= true;
		$bkg->booking_details['room_total']					= $current_property_details->get_nett_accommodation_price((float)$bkg->booking_details['room_total_nodiscount'], $this->property_uid); //has to be without tax

		$bkg->booking_details['booking_number']				= (int)filter_var($booking_number, FILTER_SANITIZE_SPECIAL_CHARS ) ;
		$bkg->booking_details['booked_in'] 					= false;
		$bkg->booking_details['requestedRoom'] 				= $new_booking->roomId."^0"; //it needs to have the ^tariff_uid too */

		//Now let`s set the new guest details
		if ( $new_booking->guestFirstName == "")
			{
			$bang = explode(" ",$new_booking->guestName);
			if (count($bang)==2)
				{
				$new_booking->guestFirstName = $bang[0];
				$new_booking->guestName = $bang[1];
				}
			elseif (count($bang)==3)
				{
				$new_booking->guestFirstName = $bang[0]." ".$bang[1];
				$new_booking->guestName = $bang[2];
				}
			else
				$new_booking->guestFirstName = "unknown";
			}

		$bkg->guest_details['firstname']	 	= filter_var( $new_booking->guestFirstName, FILTER_SANITIZE_SPECIAL_CHARS );
		$bkg->guest_details['surname']		 	= filter_var( $new_booking->guestName, FILTER_SANITIZE_SPECIAL_CHARS );
		$bkg->guest_details['house']		 	= "";
		$bkg->guest_details['street']		 	= filter_var( $new_booking->guestAddress, FILTER_SANITIZE_SPECIAL_CHARS );
		$bkg->guest_details['town']			 	= filter_var( $new_booking->guestCity, FILTER_SANITIZE_SPECIAL_CHARS );
		$bkg->guest_details['region']		 	= "";
		$bkg->guest_details['country']		 	= filter_var( $new_booking->guestCountry, FILTER_SANITIZE_SPECIAL_CHARS );
		$bkg->guest_details['postcode']	 		= filter_var( $new_booking->guestPostcode, FILTER_SANITIZE_SPECIAL_CHARS );
		$bkg->guest_details['tel_landline']		= filter_var( $new_booking->guestPhone, FILTER_SANITIZE_SPECIAL_CHARS );;
		$bkg->guest_details['tel_mobile']	 	= filter_var( $new_booking->guestMobile, FILTER_SANITIZE_SPECIAL_CHARS );;
		$bkg->guest_details['email']		 	= filter_var( $new_booking->guestEmail, FILTER_SANITIZE_EMAIL );

		$MiniComponents =jomres_getSingleton('mcHandler');
		unset($MiniComponents->registeredClasses['03110send_email_guest_newbooking']);  // Prevents the guest from receiving booking emails

		//Finally let`s insert the new booking
		$insert_result = $bkg->create_booking();
		return $insert_result;
		}

	// Dates must be presented in "Y/m/d" format
	function find_available_rooms_for_date_range($arrivalDate,$departureDate)
		{
		$mrConfig = getPropertySpecificSettings($this->property_uid);
		
		$dates_array 	= findDateRangeForDates( $arrivalDate, $departureDate );

		if ($mrConfig[ 'wholeday_booking' ] == '0')
			{
			//last booked date to check for availability is one day before the departure date
			$dates_array	= array_slice($dates_array, 0, count($dates_array)-1, true);
			}

		// We're going to put all room uids into an array, then subsequently remove that room uid if it's booked on any of the dates
		$availability = $this->default_availability;
		$gor = genericOr($dates_array,'date',false);
		
		$query="SELECT a.room_uid FROM #__jomres_room_bookings a CROSS JOIN #__jomres_rooms b ON a.room_uid = b.room_uid WHERE a.property_uid = ".$this->property_uid." AND b.room_classes_uid = ".(int)$this->room_type." AND a.date IN ('".implode('\',\'',$dates_array)."') ";
		
		$bookingsList = doSelectSql($query);

		if ( count($bookingsList)>0)
			{
			foreach ($bookingsList as $booking)
				{
				$room_uid = $booking->room_uid;
				unset($availability[$room_uid]);
				}
			}

		return $availability;
		}

	function getRetVals()
		{
		return $this->retVals;
		}
	}

/* 			$date = $events[0]['DTSTART'];
			echo 'The ical date: ';
			echo $date;
			echo "<br />\n";
			echo 'The Unix timestamp: ';
			echo $ical->iCalDateToUnixTimestamp($date);
			echo "<br />\n";
			echo 'The number of events: ';
			echo $ical->event_count;
			echo "<br />\n";
			echo 'The number of todos: ';
			echo $ical->todo_count;
			echo "<br />\n";
			echo '<hr/><hr/>';
			foreach ($events as $event) {
				echo 'SUMMARY: ' . @$event['SUMMARY'] . "<br />\n";
				echo 'DTSTART: ' . $event['DTSTART'] . ' - UNIX-Time: ' . $ical->iCalDateToUnixTimestamp($event['DTSTART']) . "<br />\n";
				echo 'DTEND: ' . $event['DTEND'] . "<br />\n";
				echo 'DTSTAMP: ' . $event['DTSTAMP'] . "<br />\n";
				echo 'UID: ' . @$event['UID'] . "<br />\n";
				echo 'CREATED: ' . @$event['CREATED'] . "<br />\n";
				echo 'LAST-MODIFIED: ' . @$event['LAST-MODIFIED'] . "<br />\n";
				echo 'DESCRIPTION: ' . @$event['DESCRIPTION'] . "<br />\n";
				echo 'LOCATION: ' . @$event['LOCATION'] . "<br />\n";
				echo 'SEQUENCE: ' . @$event['SEQUENCE'] . "<br />\n";
				echo 'STATUS: ' . @$event['STATUS'] . "<br />\n";
				echo 'TRANSP: ' . @$event['TRANSP'] . "<br />\n";
				echo 'ORGANIZER: ' . @$event['ORGANIZER'] . "<br />\n";
				echo 'ATTENDEE(S): ' . @$event['ATTENDEE'] . "<br />\n";
				echo '<hr/>';
			} */