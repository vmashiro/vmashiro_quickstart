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
 * Saves a tariff
 #
* @package Jomres
#
 */
class j06002save_tariff_micromanage {
	/**
	#
	 * Constructor: Saves a tariff
	#
	 */
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return 
		$MiniComponents =jomres_singleton_abstract::getInstance('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		date_default_timezone_set('UTC');
		
		$defaultProperty=getDefaultProperty();
		$mrConfig=getPropertySpecificSettings();
		if ($mrConfig['tariffmode']!='2')
			return;

		$tariffinput		= $_POST['tariffinput'];
		$mindaysinput		= $_POST['mindaysinput'];
		$tarifftypeid		=intval(jomresGetParam( $_REQUEST, 'tarifftypeid', 0 ));
		$tarifftypename		=jomresGetParam( $_POST, 'tarifftypename', "" );
		$tarifftypedesc		=jomresGetParam( $_POST, 'tarifftypedesc', "" );
		$mindays			=intval(jomresGetParam( $_POST, 'mindays', 0 ));
		$maxdays			=intval(jomresGetParam( $_POST, 'maxdays', 0 ));
		$minpeople			=intval(jomresGetParam( $_POST, 'minpeople', 0 ));
		$maxpeople			=intval(jomresGetParam( $_POST, 'maxpeople', 0 ));
		$roomClass			=intval(jomresGetParam( $_POST, 'roomClass', 0 ));
		$fixed_dayofweek	=intval(jomresGetParam( $_POST, 'fixed_dayofweek', 0 ));
		
		$ignore_pppn       = intval( jomresGetParam( $_POST, 'ignore_pppn', 0 ) );
		$allow_we          = intval( jomresGetParam( $_POST, 'allow_we', 0 ) );
		$weekendonly       = intval( jomresGetParam( $_POST, 'weekendonly', 0 ) );
		$minrooms_alreadyselected       = intval( jomresGetParam( $_POST, 'minrooms_alreadyselected', 0 ) );
		$maxrooms_alreadyselected       = intval( jomresGetParam( $_POST, 'maxrooms_alreadyselected', 100 ) );

		// security check
		if ($tarifftypeid > 0)
			{
			$query="SELECT `name` FROM #__jomcomp_tarifftypes WHERE id = '".(int)$tarifftypeid."' AND property_uid = '".(int)$defaultProperty."' ";
			$result=doSelectSql($query);
			if (count($result) == 0)
				trigger_error ("Unable to update tariff details, incorrect tarifftype id / property uid combination. Possible hack attempt", E_USER_ERROR);
			}
		$newTariffsArray=array();
		
		reset($tariffinput);
		for($i = 0;$i <= 0; $i++) next($tariffinput); // Setting the pointer to the first element in the array to find the key, and thereby the first date in the tariffs
		$lastdate=date("Y/m/d",key($tariffinput));
		$v=key($tariffinput);
		$lastvalue=convert_entered_price_into_safe_float($tariffinput[$v]);
		$lastmindays = (float)$mindaysinput[$v];
		$counter=0;
		
		$tariffinput_count=count($tariffinput);
		
		// Let's construct an array that'll contain the important parts of our new tariffs
		foreach ($tariffinput as $epoch=>$value)
			{
			$value = convert_entered_price_into_safe_float($value);
			
			$counter++;
			$epoch=(int)$epoch;
			
			$date=date("Y/m/d",$epoch);
			$daybefore=date("Y/m/d",strtotime("-1 day",$epoch));
			
			$mindays_value = (int)$mindaysinput[$epoch];

			if (!is_null($lastvalue))
				{
				if ($value!=$lastvalue || $mindays_value != $lastmindays)
					{
					$newTariffsArray[]=array('start'=>$lastdate,'end'=>$daybefore,'value'=>$lastvalue,"mindays"=>$lastmindays);
					$lastdate=$date;
					if ($counter == $tariffinput_count)
						{
						$start_date = $date;
						$end_date = date("Y/m/d",strtotime("+1 day",$epoch));
						$newTariffsArray[]=array('start'=>$start_date,'end'=>$end_date,'value'=>end($tariffinput),"mindays"=>$lastmindays);
						}
					}
				else
					{
					
					if ($counter == $tariffinput_count)
						{
						$newTariffsArray[]=array('start'=>$lastdate,'end'=>$date,'value'=>$lastvalue,"mindays"=>$lastmindays);
						$lastdate=$date;
						}
					}
				}
			$lastvalue=$value;
			$lastmindays = (int)$mindaysinput[$epoch];
			}

		if ($tarifftypeid > 0)
			{
			// next we need to find all the tariff uids that are associated with this tariff type
			$query="SELECT tariff_id FROM #__jomcomp_tarifftype_rate_xref WHERE tarifftype_id = '".(int)$tarifftypeid."'";
			$rateIds=doSelectSql($query);
			$rates=array();
			foreach ($rateIds as $r)
				{
				$rates[]=$r->tariff_id;
				}
			// now we can remove the old tariffs
			if (count($rates)>0)
				{
				$query="DELETE FROM #__jomres_rates WHERE rates_uid IN (".implode(',',$rates).") ";
				//echo $query."<br>";
				$result=doInsertSql($query,'');
				}
			// delete the old __jomcomp_tarifftype_rate_xref records
			if (count($rates)>0)
				{
				$query="DELETE FROM #__jomcomp_tarifftype_rate_xref WHERE tariff_id IN (".implode(',',$rates).") ";
				//echo $query."<br>";
				$result=doInsertSql($query,'');
				}
			}

		// and create new ones based on the new details
		$newRateIds=array();
		
		foreach ($newTariffsArray as $t)
			{
			// We need all of the new rate ids, so can't use multiple insert here, instead we'll insert each at a time
			$validfrom_ts=str_replace("/","-",$t['start']);
			$validto_ts=str_replace("/","-",$t['end']);
			$query="INSERT INTO #__jomres_rates (
			`rate_title`,`rate_description`,`validfrom`,`validto`,`roomrateperday`,`mindays`,`maxdays`,
			`minpeople`,`maxpeople`,`roomclass_uid`,
			`ignore_pppn`,`allow_ph`,`allow_we`,`weekendonly`,`dayofweek`,`minrooms_alreadyselected`,`maxrooms_alreadyselected`,
			`validfrom_ts`,`validto_ts`,`property_uid`
			)
			VALUES
			('$tarifftypename','$tarifftypedesc','".$t['start']."','".$t['end']."','".$t['value']."','".(int)$t['mindays']."','".(int)$maxdays."',
			'".(int)$minpeople."','".(int)$maxpeople."','".(int)$roomClass."',
			'".(int)$ignore_pppn."','0','".(int)$allow_we."','".(int)$weekendonly."',".(int)$fixed_dayofweek.",'".(int)$minrooms_alreadyselected."','".(int)$maxrooms_alreadyselected."',
			'".$validfrom_ts."','".$validto_ts."','".(int)$defaultProperty."')";
			//echo $query."<br>";
			$newRateIds[]=doInsertSql($query,'');
			}

		// finally we want to create a new tariff type if it doesn't exist
		if ($tarifftypeid==0)
			{
			$query="INSERT INTO #__jomcomp_tarifftypes (`name`,`description`,`property_uid`) VALUES ('$tarifftypename','$tarifftypedesc','".(int)$defaultProperty."')";
			$tarifftypeid=doInsertSql($query,'');
			}
		else
			{
			$query="UPDATE #__jomcomp_tarifftypes SET `name`='$tarifftypename', `description`='$tarifftypedesc' WHERE id = '".(int)$tarifftypeid."' AND property_uid = '".(int)$defaultProperty."'";
			$result=doInsertSql($query,'');
			}
		//echo $query."<br>";
		// and update __jomcomp_tarifftype_rate_xref with the tariff type/tariff uids.
		$newRateStr="";
		$counter=1;
		foreach ($newRateIds as $r)
			{
			$newRateStr.="('".(int)$tarifftypeid."','".(int)$r."','".(int)$roomClass."','".(int)$defaultProperty."')";
			if ($counter< count($newRateIds) )
				$newRateStr.=",";
			$counter++;
			}
		$jomres_messaging =jomres_singleton_abstract::getInstance('jomres_messages');
		$jomres_messaging->set_message(jr_gettext('_JOMRES_MR_AUDIT_INSERT_TARIFF',_JOMRES_MR_AUDIT_INSERT_TARIFF,FALSE));
		$query="INSERT INTO #__jomcomp_tarifftype_rate_xref (`tarifftype_id`,`tariff_id`,`roomclass_uid`,`property_uid`) VALUES ".$newRateStr;
		if (doInsertSql($query,jr_gettext('_JOMRES_MR_AUDIT_INSERT_TARIFF',_JOMRES_MR_AUDIT_INSERT_TARIFF,FALSE))) 
			jomresRedirect( jomresURL( JOMRES_SITEPAGE_URL . "&task=list_tariffs_micromanage" ), "" );
		else
			trigger_error ("Unable to update tariff details, mysql db failure", E_USER_ERROR);
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