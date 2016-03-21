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
 * Constructs the create new black booking page
 #
* @package Jomres
#
 */
class j02134newblackbooking {
	/**
	#
	 * Constructor: Constructs the create new black booking page
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
		$mrConfig=getPropertySpecificSettings();
		$defaultProperty=getDefaultProperty();

		$output['PAGETITLE']=jr_gettext('_JOMRES_FRONT_BLACKBOOKING',_JOMRES_FRONT_BLACKBOOKING);
		if ($mrConfig['singleRoomProperty']=="1")
			$output['INSTRUCTIONS']=jr_gettext('_JOMRES_FRONT_BLACKBOOKING_DESC_SRP',_JOMRES_FRONT_BLACKBOOKING_DESC_SRP,false);
		else
			$output['INSTRUCTIONS']=jr_gettext('_JOMRES_FRONT_BLACKBOOKING_DESC',_JOMRES_FRONT_BLACKBOOKING_DESC,false);

		
		$rmcounter=0;

		if (!isset($_POST['saveBBooking']) )
			{
			$today = date("Y/m/d");
			$date_elements  = explode("/",$today);
			$unixOneWeek= mktime(0,0,0,$date_elements[1],$date_elements[2]+7,$date_elements[0]);
			$end = date("Y/m/d",$unixOneWeek);
			$start=$today;
			$firstTimeAround=1;
			if (isset($_POST['start']))
				{
				$start=JSCalConvertInputDates($_POST['start']);
				$firstTimeAround=0;
				}
			if (isset($_POST['end']))
				{
				$end=JSCalConvertInputDates($_POST['end']);
				$firstTimeAround=0;
				}
			$date_elements  = explode("/",$start);
			$unixStart= mktime(0,0,0,$date_elements[1],$date_elements[2],$date_elements[0]);
			$date_elements  = explode("/",$end);
			$unixEnd= mktime(0,0,0,$date_elements[1],$date_elements[2],$date_elements[0]);
			if ($unixEnd<=$unixStart)
				{
				$date_elements  = explode("/",$start);
				$unixEnd= mktime(0,0,0,$date_elements[1],$date_elements[2]+7,$date_elements[0]);
				$end = date("Y/m/d",$unixEnd);
				}

			$okToContinue=TRUE;
			$output['BBDATESTARTS']=jr_gettext('_JOMRES_FRONT_MR_MENU_ADMIN_BLACKBOOKINGS_BBSTARTS',_JOMRES_FRONT_MR_MENU_ADMIN_BLACKBOOKINGS_BBSTARTS);
			$output['BBSTARTJSBOX']=generateDateInput("start",$start);
			
			$output['BBDATEENDS']=jr_gettext('_JOMRES_FRONT_MR_MENU_ADMIN_BLACKBOOKINGS_BBSERVICERESUMES',_JOMRES_FRONT_MR_MENU_ADMIN_BLACKBOOKINGS_BBSERVICERESUMES);
			$output['BBENDSJSBOX']=generateDateInput("end",$end);
			$query="SELECT room_uid,room_number,room_name FROM #__jomres_rooms WHERE propertys_uid = '".(int)$defaultProperty."'";
			$roomsList = doSelectSql($query);
			$counter=0;
			$totalRooms=count($roomsList);
			$link=jomresURL(JOMRES_SITEPAGE_URL_NOHTML."&task=editBooking&popup=1&contract_uid=");
			$ok_to_blackbook = true;
			if (count($roomsList) >0)
				{
				foreach ($roomsList as $room)
					{
					$links="";
					$row=array();
					$checked="";
					$dateRangeArray= $this->bb_getDateRange($start,$end);
					$contractUidArray=array();
					foreach ($dateRangeArray as $theDate)
						{
						$query="SELECT room_bookings_uid,contract_uid FROM #__jomres_room_bookings WHERE room_uid = '".(int)$room->room_uid."' AND date = '$theDate'";
						$bookingsList = doSelectSql($query);
						if (count($bookingsList)>0)
							{
							foreach ($bookingsList as $booking)
								{
								$contractUidArray[]=$booking->contract_uid;
								}
							}
						}
					$contractUidArray=array_unique($contractUidArray);
					$text=jr_gettext('_JOMRES_COM_MR_EB_ROOM_NUMBER',_JOMRES_COM_MR_EB_ROOM_NUMBER).' '.$room->room_number." ".$room->room_name;
					
					if (count($contractUidArray)>0)
						{
						
						if ($mrConfig['singleRoomProperty']=="1")
							{
							$ok_to_blackbook = false;
							$row['BBMESSAGE_CLASS']="ui-state-error";
							$row['BBMESSAGE']=jr_gettext('_JOMRES_FRONT_BLACKBOOKING_SRP_CANNOTBLACKBOOK',_JOMRES_FRONT_BLACKBOOKING_SRP_CANNOTBLACKBOOK);
							$row['HIDDEN']="";
							}
						else
							{
							foreach ($contractUidArray as $contract)
								{
								$status = 'status=no,toolbar=yes,scrollbars=yes,titlebar=no,menubar=yes,resizable=yes,width=500,height=500,directories=no,location=no';
								$link =JOMRES_SITEPAGE_URL."&task=editBooking&tmpl=".get_showtime('tmplcomponent')."&popup=1&contract_uid=".$contract;
								$links.='<a href="javascript:void window.open(\''.$link.'\', \'win2\', \''.$status.'\');" title=""> '.jr_gettext('_JOMRES_COM_MR_EB_PAYM_BOOKINGNUMBER',_JOMRES_COM_MR_EB_PAYM_BOOKINGNUMBER).' '.$contract.' </a>';
								}
							$rmcounter++;
							$row['TEXT']=$text.$links;
							$row['CHECKBOX']="&nbsp;";
							}
						}
					else
						{
						if ($mrConfig['singleRoomProperty']=="1")
							{
							$row['BBMESSAGE_CLASS']="ui-state-highlight";
							$row['BBMESSAGE']=jr_gettext('_JOMRES_FRONT_BLACKBOOKING_SRP_CANBLACKBOOK',_JOMRES_FRONT_BLACKBOOKING_SRP_CANBLACKBOOK);
							$row['HIDDEN']='<input type="hidden" name="idarray[]" value="'.$room->room_uid.'">';
							}
						else
							{
							$row['CHECKBOX']='<input type="checkbox" id="cb'.$counter.'" name="idarray[]" value="'.$room->room_uid.'" onClick="jomres_isChecked(this.checked);">';
							$row['TEXT']=$text;
							}
						}
					if ($counter%2)
						$row['CLASS']="even";
					else
						$row['CLASS']="odd";
					$counter++;
					$bookingsrow[]=$row;
					}
				
				}
			}
			
		// If we put this into it's own template row, we can ensure that the headers aren't shown if Apply hasn't been hit yet.
		$rowsheader = array();
		$reason_output = array();
		$routput=array();
		if (isset($_POST['start']))
			{
			$rowsheader[] = array ('TOTALINLISTPLUSONE'=>$counter+1,'ROOM_NUMBER'=>jr_gettext('_JOMRES_COM_MR_VRCT_ROOM_HEADER_NUMBER',_JOMRES_COM_MR_VRCT_ROOM_HEADER_NUMBER),'ROOM_NAME'=>jr_gettext('_JOMRES_COM_MR_EB_ROOM_NAME',_JOMRES_COM_MR_EB_ROOM_NAME));
			$routput['REASON']=jr_gettext('_JOMRES_JR_BLACKBOOKING_REASON',_JOMRES_JR_BLACKBOOKING_REASON);
			$routput['_JOMRES_JR_BLACKBOOKING_REASON']=jr_gettext('_JOMRES_JR_BLACKBOOKING_REASON',_JOMRES_JR_BLACKBOOKING_REASON);
			}
		$reason_output[]=$routput;

		$cancelText=jr_gettext('_JOMRES_COM_A_CANCEL',_JOMRES_COM_A_CANCEL,FALSE);
		$jrtbar =jomres_getSingleton('jomres_toolbar');
		$jrtb  = $jrtbar->startTable();
		
		$jrtb .= $jrtbar->toolbarItem('apply',jomresURL(JOMRES_SITEPAGE_URL."&task=newBlackBooking"),'Apply',true,'newBlackBooking');
		$jrtb .= $jrtbar->toolbarItem('cancel',jomresURL(JOMRES_SITEPAGE_URL."&task=listBlackBookings"),$cancelText);
		if (isset($_POST['start']) && $ok_to_blackbook)
			$jrtb .= $jrtbar->toolbarItem('save',jomresURL(JOMRES_SITEPAGE_URL."&task=saveBBooking"),jr_gettext('_JOMRES_COM_MR_SAVE',_JOMRES_COM_MR_SAVE,FALSE),true,'saveBBooking');
		
		$jrtb .= $jrtbar->endTable();
		$output['JOMRESTOOLBAR']=$jrtb;

		$output['JOMRES_SITEPAGE_URL']=JOMRES_SITEPAGE_URL;


		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		$tmpl->setRoot( JOMRES_TEMPLATEPATH_BACKEND );
		if ($mrConfig['singleRoomProperty']=="1")
			$tmpl->readTemplatesFromInput( 'new_SRP_black_booking.html' );
		else
			$tmpl->readTemplatesFromInput( 'new_black_booking.html' );
			
		$tmpl->addRows( 'pageoutput', $pageoutput );
		if (isset($_POST['start']))
			{
			$tmpl->addRows( 'reason_output', $reason_output );
			$tmpl->addRows( 'bookingsrows', $bookingsrow );
			$tmpl->addRows( 'rowsheader', $rowsheader );
			}
		$tmpl->displayParsedTemplate();
		}

	/**
	#
	 * Sets the date range array
	#
	 */
/* 	function bb_getDateRange($start,$end)
		{
		$interval=dateDiff("d",$start,$end);
		$dateRangeArray=array();
		$date_elements  = explode("/",$start);
		$unixCurrentDate= mktime(0,0,0,$date_elements[1],$date_elements[2],$date_elements[0]);
		$secondsInDay = 86400;
		$currentUnixDay=$unixCurrentDate;
		$currentDay=$start;
		for ($i=0, $n=$interval; $i < $n; $i++)
			{
			$currentDay=date("Y/m/d",$unixCurrentDate);
			$dateRangeArray[]=$currentDay;
			//echo $currentDay;
			$unixCurrentDate=$unixCurrentDate+$secondsInDay;
			}
		$dateRangeString=implode(",",$dateRangeArray);
		return $dateRangeArray;
		} */

	function bb_getDateRange($start,$end)
		{
		$interval=dateDiff("d",$start,$end);
		$dateRangeArray=array();
		$date_elements  = explode("/",$start);
		$unixCurrentDate= mktime(0,0,0,$date_elements[1],$date_elements[2],$date_elements[0]);
		$currentDay=$start;
		for ($i=0, $n=$interval; $i < $n; $i++)
			{
			$currentDay=date("Y/m/d",$unixCurrentDate);
			$dateRangeArray[]=$currentDay;
			$unixCurrentDate=strtotime("+1 day",$unixCurrentDate);
			}
		$dateRangeString=implode(",",$dateRangeArray);
		return $dateRangeArray;
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