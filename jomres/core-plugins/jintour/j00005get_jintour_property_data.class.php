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

class j00005get_jintour_property_data {
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$ePointFilepath = get_showtime('ePointFilepath');

		$c = jomres_singleton_abstract::getInstance( 'jomres_array_cache' );
		
		if ($c->isCached('jintour_properties'))
			{
			$curr_jintour_properties=$c->retrieve('jintour_properties');
			set_showtime('jintour_properties',$curr_jintour_properties);
			}
		else
			{
			$query = "SELECT property_uid FROM #__jomres_jintour_properties";
			$props = doSelectSql($query);
			$curr_jintour_properties = array();
			if (count($props)>0)
				{
				foreach ($props as $p)
					$curr_jintour_properties[]=(int)$p->property_uid;
				}
			set_showtime('jintour_properties',$curr_jintour_properties);
			$c->store('jintour_properties',$curr_jintour_properties);
			}
		
		$result = false;
		if( in_array( (int)get_showtime('property_uid'),$curr_jintour_properties) )
			$result = true;
		
		if ($result)
			set_showtime('is_jintour_property',true);
		else
			set_showtime('is_jintour_property',false);
		
		if (get_showtime('is_jintour_property'))
			{
			set_showtime('include_room_booking_functionality',false);
			
			unset($MiniComponents->registeredClasses['00013dashboard']);
			if (isset($MiniComponents->registeredClasses['00013schedule']))
				unset($MiniComponents->registeredClasses['00013schedule']);
			
			// Disable a bunch of menu options that we don't need
			unset($MiniComponents->registeredClasses['00010reception_option_04_blackbookings']);
			unset($MiniComponents->registeredClasses['00010reception_option_06_listnewbookings']);
			unset($MiniComponents->registeredClasses['00010reception_option_06_listoldbookings']);
			unset($MiniComponents->registeredClasses['00010reception_option_07_bookaguestin']);
			unset($MiniComponents->registeredClasses['00010reception_option_08_bookaguestout']);
			//unset($MiniComponents->registeredClasses['00010reception_option_08_listguests']);
			unset($MiniComponents->registeredClasses['00011manager_option_02_propertyadmin']);
			unset($MiniComponents->registeredClasses['00011manager_option_04_guesttypeadmin']);
			//unset($MiniComponents->registeredClasses['00011manager_option_05_couponadmin']);
			unset($MiniComponents->registeredClasses['00011manager_option_07_stats']);
			unset($MiniComponents->registeredClasses['00011manager_option_14_remote_connectivity']);
			unset($MiniComponents->registeredClasses['00011manager_option_01_tariffs']);

			// Here we'll set custom paths to our templates or redirect calls to different pages, much better than creating minicomponents to do the same work when all we want to do is modify the resulting output, 
			if (isset($_REQUEST['task']))
				{
				
				if ($_REQUEST['task'] == "preview" || $_REQUEST['task'] == "viewproperty")
					{
					unset($MiniComponents->registeredClasses['00035tabcontent_04_availability_calendar']);
					unset($MiniComponents->registeredClasses['00035tabcontent_04_roomslist']);
					unset($MiniComponents->registeredClasses['00035tabcontent_05_tariffs']);
					unset($MiniComponents->registeredClasses['00035tabcontent_01_more_info']);

					// N/A now in 4.7, we can use the composite property details that comes with Jomres.
					//$current_custom_paths = get_showtime('custom_paths');
					//$current_custom_paths['composite_property_details.html'] = $ePointFilepath.'templates';
					//set_showtime('custom_paths',$current_custom_paths);
					}
				if ($_REQUEST['task'] == "editProperty")
					{
					$current_custom_paths = get_showtime('custom_paths');
					$current_custom_paths['edit_property.html'] = $ePointFilepath.'templates'.JRDS.find_plugin_template_directory();
					set_showtime('custom_paths',$current_custom_paths);
					}
				
				if ($_REQUEST['task'] == "dobooking")
					{
					$current_custom_paths = get_showtime('custom_paths');
					$current_custom_paths['dobooking.html'] = $ePointFilepath.'templates'.JRDS.find_plugin_template_directory();
					set_showtime('custom_paths',$current_custom_paths);
					}
					
				if ($_REQUEST['task'] == "editBooking" && !isset($_REQUEST['id']) )
					{
					$contract_uid = $_REQUEST['contract_uid'];
					$query = "SELECT tour_id FROM #__jomres_jintour_tour_bookings WHERE contract_id = ".(int)$contract_uid;
					$tour_id = doSelectSql($query,1);
					jomresRedirect( jomresURL( JOMRES_SITEPAGE_URL."&task=editBooking&id=".$tour_id."&contract_uid=".$contract_uid ), "" );
					}
				
				if ($_REQUEST['task'] == "editBooking" && isset($_REQUEST['id']) )
					{
					$rooms_tab_replacement = $MiniComponents->specificEvent('06002','jintour_view_tour_bookings',array('id'=>(int)$_REQUEST['id'],"defer_output"=>true));
					set_showtime('rooms_tab_replacement',$rooms_tab_replacement);
					}
				
				
				if ($_REQUEST['task'] == "propertyadmin")
					{
					jomresRedirect( jomresURL( JOMRES_SITEPAGE_URL."&task=jintour" ), "" );
					}
					
				}
			}

		if ($_REQUEST['task'] == "muviewbooking")
			{
			$thisJRUser=jomres_getSingleton('jr_user');
			if ($thisJRUser->userIsRegistered)
				{
				$contract_uid			= jomresGetParam( $_REQUEST, 'contract_uid', 0 );
				$allGuestUids=array();

				if (!$thisJRUser->is_partner)
					$query       = "SELECT guests_uid FROM #__jomres_guests WHERE mos_userid = '" . (int) $thisJRUser->id . "' ";
				else
					$query       = "SELECT guests_uid FROM #__jomres_guests WHERE partner_id = '" . (int) $thisJRUser->id . "' ";
				
				$guests_uids=doSelectSql($query);

				// Because a new record is made in the guests table for each new property the guest registers in, we need to find all the guest uids for this user
				if (count($guests_uids) > 0)
					{
					foreach ($guests_uids as $g)
						{
						$allGuestUids[]=$g->guests_uid;
						}
					}
				$query="SELECT guest_uid,property_uid FROM #__jomres_contracts WHERE contract_uid = '".(int)$contract_uid."' AND guest_uid IN (".implode(',',$allGuestUids).") LIMIT 1";
				$data = doSelectSql($query,2);
				$guest_id = $data['guest_uid'];
				$property_uid = $data['property_uid'];
				
				
				if (in_array($property_uid,$curr_jintour_properties))
					{
					$query = "SELECT tour_id FROM #__jomres_jintour_tour_bookings WHERE contract_id = ".(int)$contract_uid;
					$tour_id = doSelectSql($query,1);

					$rooms_tab_replacement = $MiniComponents->specificEvent('06005','jintour_guest_view_tour_bookings',array('id'=>(int)$tour_id,"defer_output"=>true,"property_uid"=>$property_uid,"contract_uid"=>$contract_uid));
					set_showtime('rooms_tab_replacement',$rooms_tab_replacement);
					}
				}
			}
		
		if ($_REQUEST['task'] == "registerProp_step2" && $_REQUEST['management_process']=="jintour")
			{
			$current_custom_paths = get_showtime('custom_paths');
			$current_custom_paths['register_property2.html'] = $ePointFilepath.'templates'.JRDS.find_plugin_template_directory();
			
			set_showtime('custom_paths',$current_custom_paths);
			}
		}

	/**
	#
	 * Must be included in every mini-component
	#
	 */
	function getRetVals()
		{
		return null;
		}
	}

?>